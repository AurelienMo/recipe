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

use App\Domain\Model\GroupUser;
use App\Domain\Model\Product;
use App\Domain\Model\StockProduct;

/**
 * Class StockProductBuilder
 */
class StockProductBuilder
{
    public static function create(
        GroupUser $groupUser,
        Product $product,
        float $quantity
    ) {
        return new StockProduct(
            $quantity,
            $product,
            $groupUser
        );
    }
}
