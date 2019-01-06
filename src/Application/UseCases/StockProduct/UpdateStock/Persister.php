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

namespace App\Application\UseCases\StockProduct\UpdateStock;

use App\Application\UseCases\AbstractPersister;
use App\Application\UseCases\InputInterface;
use App\Application\UseCases\Products\Add\Output\AddProductOutput;
use App\Application\UseCases\StockProduct\Output\StockItemOutput;
use App\Domain\Model\StockProduct;
use App\UI\Responders\OutputInterface;

/**
 * Class Persister
 */
class Persister extends AbstractPersister
{
    /**
     * @param InputInterface|UpdateStockProductInput $input
     *
     * @return OutputInterface|null
     */
    public function save(InputInterface $input): ?OutputInterface
    {
        if ($input->getStock()->getQuantity() !== $input->getQuantity()) {
            $input->getStock()->updateQuantity($input->getQuantity());
            $this->entityManager->flush();
        }


        return $this->buildOutput($input->getStock());
    }

    protected function getClassRepository(): string
    {
        return StockProduct::class;
    }

    private function buildOutput(StockProduct $stock)
    {
        $product = $stock->getProduct();
        return new StockItemOutput(
            $stock->getId(),
            new AddProductOutput(
                $product->getId(),
                $product->getName(),
                $product->getSlug(),
                $product->getTypeProduct()->getId(),
                $product->getTypeQuantity()->getId()
            ),
            $stock->getQuantity()
        );
    }
}
