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
use Doctrine\ORM\Mapping as ORM;

/**
 * Class StockProduct
 */
class StockProduct extends AbstractModel
{
    use QuantityTrait;

    /** @var Product */
    protected $product;

    /**
     * StockProduct constructor.
     *
     * @param float   $quantity
     * @param Product $product
     */
    public function __construct(
        float $quantity,
        Product $product
    ) {
        $this->quantity = $quantity;
        $this->product = $product;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}
