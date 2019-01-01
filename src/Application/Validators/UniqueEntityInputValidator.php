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

namespace App\Application\Validators;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class UniqueEntityInputValidator
 */
class UniqueEntityInputValidator
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function validate(
        $value,
        Constraint $constraint
    ) {
        if (!$constraint instanceof UniqueEntityInput) {
            throw new UnexpectedTypeException($constraint, __NAMESPACE__.'\UniqueEntityInput');
        }

        if (null === $value || '' === $value) {
            return;
        }

        $fields = (array) $constraint->fields;
        foreach ($fields as $name) {
            $fieldValue = $value->{'get'.ucfirst($name)}();
            $object = $this->entityManager->getRepository($constraint->class)
                ->findOneBy(
                    [
                        $name => $fieldValue,
                    ]
                );
            if ($object && $this->context->getViolations()->count() === 0) {
                $this->context->buildViolation($constraint->message)
                    ->addViolation();
            }
        }
    }
}
