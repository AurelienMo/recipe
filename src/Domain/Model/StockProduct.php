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

namespace App\Domain\Model;

use App\Domain\Model\Traits\QuantityTrait;

/**
 * Class StockProduct
 */
class StockProduct extends AbstractModel
{
    use QuantityTrait;

    /** @var Product */
    protected $product;

    /** @var GroupUser */
    protected $group;

    /**
     * StockProduct constructor.
     *
     * @param float     $quantity
     * @param Product   $product
     * @param GroupUser $group
     */
    public function __construct(
        float $quantity,
        Product $product,
        GroupUser $group
    ) {
        $this->quantity = $quantity;
        $this->product = $product;
        $this->group = $group;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return GroupUser
     */
    public function getGroup(): GroupUser
    {
        return $this->group;
    }

    public function updateQuantity(float $quantity)
    {
        $this->quantity = $quantity;
    }
}
