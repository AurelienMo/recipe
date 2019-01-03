<?php

declare(strict_types=1);

/*
 * This file is part of homemanagement-be
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use App\Domain\Model\User;
use Behat\Behat\Context\Context;
use Doctrine\ORM\Tools\SchemaTool;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * Class DoctrineContext
 */
class DoctrineContext implements Context
{
    /** @var SchemaTool */
    private $schemaTool;

    /** @var RegistryInterface */
    private $doctrine;

    /** @var KernelInterface */
    private $kernel;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * DoctrineContext constructor.
     *
     * @param RegistryInterface            $doctrine
     * @param KernelInterface              $kernel
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(RegistryInterface $doctrine, KernelInterface $kernel, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->doctrine = $doctrine;
        $this->schemaTool = new SchemaTool($this->doctrine->getManager());
        $this->kernel = $kernel;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @BeforeScenario
     *
     * @throws \Doctrine\ORM\Tools\ToolsException
     */
    public function clearDatabase()
    {
        $this->schemaTool->dropSchema($this->doctrine->getManager()->getMetadataFactory()->getAllMetadata());
        $this->schemaTool->createSchema($this->doctrine->getManager()->getMetadataFactory()->getAllMetadata());
    }

    /**
     * @param string $file
     *
     * @Given I load following file :file
     */
    public function iLoadFollowingFile(string $file)
    {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(__DIR__.'/../fixtures/'.$file);
        foreach ($objectSet->getObjects() as $object) {
            if ($object instanceof User) {
                $user = new User(
                    $object->getFirstname(),
                    $object->getLastname(),
                    $object->getUsername(),
                    $object->getEmail(),
                    $this->passwordEncoder->encodePassword($object, $object->getPassword()),
                    $object->getRoles()[0]
                );
                $this->doctrine->getManager()->persist($user);

            } else {
                $this->doctrine->getManager()->persist($object);
            }
        }

        $this->doctrine->getManager()->flush();
    }
}
