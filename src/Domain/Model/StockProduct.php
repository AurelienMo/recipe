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
 *
 * @ORM\Table(name="amo_stock_product")
 * @ORM\Entity()
 */
class StockProduct extends AbstractModel
{
    use QuantityTrait;

    /**
     * @var TypeQuantity
     *
     * @ORM\ManyToOne(targetEntity="TypeQuantity")
     * @ORM\JoinColumn(name="type_quantity_id", referencedColumnName="id")
     */
    protected $typeQuantity;

    /**
     * @var Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    protected $product;

    /**
     * StockProduct constructor.
     *
     * @param float        $quantity
     * @param TypeQuantity $typeQuantity
     * @param Product      $product
     */
    public function __construct(
        float $quantity,
        TypeQuantity $typeQuantity,
        Product $product
    ) {
        $this->quantity = $quantity;
        $this->typeQuantity = $typeQuantity;
        $this->product = $product;
    }

    /**
     * @return TypeQuantity
     */
    public function getTypeQuantity(): TypeQuantity
    {
        return $this->typeQuantity;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }
}
