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

namespace App\Domain\Builders;

use App\Domain\Model\Product;
use App\Domain\Model\TypeProduct;
use App\Domain\Model\TypeQuantity;

/**
 * Class ProductBuilder
 */
class ProductBuilder
{
    /**
     * @param string       $name
     * @param TypeProduct  $typeProduct
     * @param TypeQuantity $typeQuantity
     *
     * @return Product
     */
    public static function build(
        string $name,
        TypeProduct $typeProduct,
        TypeQuantity $typeQuantity
    ) {
        return new Product(
            $name,
            $typeProduct,
            $typeQuantity
        );
    }
}
