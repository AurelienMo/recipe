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

namespace App\Application\UseCases;

use App\UI\Responders\OutputInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AbstractPersister
 */
abstract class AbstractPersister
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * AbstractPersister constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param InputInterface $input
     *
     * @return OutputInterface|null
     */
    abstract public function save(InputInterface $input): ?OutputInterface;

    /**
     * @return string
     */
    abstract protected function getClassRepository(): string;

    /**
     * @param string|null $class
     *
     * @return ObjectRepository
     */
    protected function getRepository(?string $class = null): ObjectRepository
    {
        return $this->entityManager->getRepository(
            is_null($class) ? $this->getClassRepository() : $class
        );
    }
}
