<?php

declare(strict_types=1);

/*
 * This file is part of recipe
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Application\Command;

use App\Application\Command\GenerateUser\GeneratedUserInput;
use App\Application\Helpers\Core\ErrorsBuilder;
use App\Domain\Builders\UserBuilder;
use App\Domain\Model\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class GenerateUserCommand
 */
class GenerateUserCommand extends Command
{
    const FIELDS_TO_CREATE = [
        'firstname' => null,
        'lastname' => null,
        'username' => null,
        'email' => null,
        'password' => null,
        'roles' => null,
    ];

    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var EncoderFactoryInterface */
    protected $encoderFactory;

    /** @var ValidatorInterface */
    protected $validator;

    /**
     * GenerateUserCommand constructor.
     *
     * @param string|null             $name
     * @param EntityManagerInterface  $entityManager
     * @param EncoderFactoryInterface $encoderFactory
     * @param ValidatorInterface      $validator
     */
    public function __construct(
        ?string $name = null,
        EntityManagerInterface $entityManager,
        EncoderFactoryInterface $encoderFactory,
        ValidatorInterface $validator
    ) {
        $this->entityManager = $entityManager;
        $this->encoderFactory = $encoderFactory;
        $this->validator = $validator;
        parent::__construct($name);
    }

    public function configure()
    {
        $this
            ->setName('app:generate-user')
            ->setDescription('Generate user with this command');
    }

    public function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $results = self::FIELDS_TO_CREATE;
        foreach ($results as $fieldName => $value) {
            $results[$fieldName] = $this->askForResult($input, $output, $fieldName);
        }

        $userInput = (new GeneratedUserInput())->unserialize(serialize($results));
        $this->validateInput($userInput);

        $user = UserBuilder::create(
            $userInput->getFirstname(),
            $userInput->getLastname(),
            $userInput->getUsername(),
            $userInput->getEmail(),
            $this->encodePassword($userInput->getPassword()),
            $userInput->getRoles()
        );

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    private function encodePassword(string $password)
    {
        $encoder = $this->encoderFactory->getEncoder(User::class);

        return $encoder->encodePassword($password, '');
    }

    private function validateInput(GeneratedUserInput $input)
    {
        $constraintList = $this->validator->validate($input);
        $errors = [];
        if (count($constraintList) > 0) {
            /** @var ConstraintViolationInterface $constraint */
            foreach ($constraintList as $constraint) {
                $errors[$constraint->getPropertyPath()] = $constraint->getMessage();
            }

            throw new \Exception(
                implode(' // ', $errors)
            );
        }
    }

    private function askForResult(InputInterface $input, OutputInterface $output, string $fieldName)
    {
        $question = new Question(sprintf("Enter %s : ", $fieldName));

        return $this->getHelperQuestion()->ask($input, $output, $question);
    }

    private function getHelperQuestion()
    {
        return $this->getHelper('question');
    }
}
