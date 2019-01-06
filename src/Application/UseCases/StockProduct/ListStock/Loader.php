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

namespace App\Application\UseCases\StockProduct\ListStock;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\AbstractLoader;
use App\Application\UseCases\Products\Add\Output\AddProductOutput;
use App\Application\UseCases\StockProduct\Output\StockItemOutput;
use App\Application\UseCases\StockProduct\Output\StockOutput;
use App\Domain\Model\StockProduct;
use App\UI\Responders\OutputInterface;

/**
 * Class Loader
 */
class Loader extends AbstractLoader
{
    /**
     * @param AbstractInput|ListStockInput|null $input
     *
     * @return OutputInterface|StockOutput
     */
    public function load(?AbstractInput $input): OutputInterface
    {
        $listStocks = $this->getRepository()->loadStock($input->getGroup(), $input->getTypeProducts());

        return $this->buildOutput($listStocks);
    }

    protected function getClassRepository(): string
    {
        return StockProduct::class;
    }

    private function buildOutput(array $listStocks)
    {
        $output = new StockOutput();
        /** @var StockProduct $stock */
        foreach ($listStocks as $stock) {
            $productModel = $stock->getProduct();
            $item = new StockItemOutput(
                $stock->getId(),
                new AddProductOutput(
                    $productModel->getId(),
                    $productModel->getName(),
                    $productModel->getSlug(),
                    $productModel->getTypeProduct()->getId(),
                    $productModel->getTypeQuantity()->getId()
                ),
                $stock->getQuantity()
            );
            $output->addItem($item);
        }

        return $output;
    }
}
