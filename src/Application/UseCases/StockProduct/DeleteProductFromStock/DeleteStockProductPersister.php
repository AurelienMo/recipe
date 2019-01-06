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

namespace App\Application\UseCases\StockProduct\DeleteProductFromStock;

use App\Application\UseCases\AbstractPersister;
use App\Application\UseCases\InputInterface;
use App\Domain\Model\StockProduct;
use App\UI\Responders\OutputInterface;

/**
 * Class DeleteStockProductPersister
 */
class DeleteStockProductPersister extends AbstractPersister
{
    /**
     * @param InputInterface|DeleteStockProductInput $input
     *
     * @return OutputInterface|null
     */
    public function save(InputInterface $input): ?OutputInterface
    {
        $this->entityManager->remove($input->getStock());
        $this->entityManager->flush();

        return null;
    }

    protected function getClassRepository(): string
    {
        return StockProduct::class;
    }
}
