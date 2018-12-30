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

use Doctrine\ORM\EntityManagerInterface;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LoadFixturesProductionCommand
 */
class LoadFixturesProductionCommand extends Command
{
    const FILE_PROD_FIXTURE = __DIR__.'/../../../config/fixtures/prod/00_load.yml';

    /** @var EntityManagerInterface */
    protected $entityManager;

    public function __construct(
        EntityManagerInterface $entityManager,
        ?string $name = null
    ) {
        $this->entityManager = $entityManager;
        parent::__construct($name);
    }

    /**
     * Configure command to load production fixtures
     */
    public function configure()
    {
        $this
            ->setName('app:load-prod-fixtures')
            ->setDescription('Load production fixtures before run application');
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int|void|null
     */
    public function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $loader = new NativeLoader();
        $objectSet = $loader->loadFile(self::FILE_PROD_FIXTURE);
        foreach ($objectSet->getObjects() as $object) {
            $this->entityManager->persist($object);
        }

        $this->entityManager->flush();
    }
}
