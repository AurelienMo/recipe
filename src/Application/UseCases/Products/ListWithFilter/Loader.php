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

namespace App\Application\UseCases\Products\ListWithFilter;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\AbstractLoader;
use App\Application\UseCases\Products\ListWithFilter\Output\ListProductOutput;
use App\Application\UseCases\Products\ListWithFilter\Output\ProductItemOutput;
use App\Domain\Model\Product;
use App\UI\Responders\OutputInterface;

/**
 * Class Loader
 */
class Loader extends AbstractLoader
{
    public function load(?AbstractInput $input): OutputInterface
    {
        $products = $this->getRepository()->loadProductsAccordingParameter($input->getTypeProducts());

        return $this->buildOutput($products);
    }

    protected function getClassRepository(): string
    {
        return Product::class;
    }

    /**
     * Build output model
     *
     * @param array $products
     *
     * @return ListProductOutput
     */
    private function buildOutput(array $products)
    {
        $list = new ListProductOutput();
        /** @var Product $product */
        foreach ($products as $product) {
            $list->addProduct(
                new ProductItemOutput(
                    $product->getId(),
                    $product->getName(),
                    $product->getTypeProduct()->getId()
                )
            );
        }

        return $list;
    }
}
