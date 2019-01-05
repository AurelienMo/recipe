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

use App\Application\Helpers\Core\TranslatorBuilder;
use App\UI\Responders\OutputInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 * Class AbstractLoader
 */
abstract class AbstractLoader
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var TranslatorBuilder */
    protected $translatorBuilder;

    /**
     * AbstractLoader constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param TranslatorBuilder      $translatorBuilder
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        TranslatorBuilder $translatorBuilder
    ) {
        $this->entityManager = $entityManager;
        $this->translatorBuilder = $translatorBuilder;
    }

    /**
     * @param AbstractInput|null $input
     *
     * @return OutputInterface
     */
    abstract public function load(?AbstractInput $input): OutputInterface;

    /**
     * @return ObjectRepository
     */
    protected function getRepository()
    {
        return $this->entityManager->getRepository($this->getClassRepository());
    }

    /**
     * @return string
     */
    abstract protected function getClassRepository(): string;
}
