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

namespace App\Application\UseCases\Products\ListWithFilter\Output;

use App\UI\Responders\OutputInterface;

/**
 * Class ListProductOutput
 */
class ListProductOutput implements OutputInterface
{
    /**
     * List products
     *
     * @var ProductItemOutput[]
     */
    protected $products = [];

    /**
     * @return array
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param ProductItemOutput $productItemOutput
     */
    public function addProduct(ProductItemOutput $productItemOutput)
    {
        $this->products[] = $productItemOutput;
    }
}
