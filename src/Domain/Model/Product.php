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

use App\Domain\Model\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @ORM\Table(name="amo_product")
 * @ORM\Entity(repositoryClass="App\Domain\Repository\ProductRepository")
 */
class Product extends AbstractModel
{
    use NameTrait;

    /**
     * @var TypeProduct
     *
     * @ORM\ManyToOne(targetEntity="TypeProduct")
     * @ORM\JoinColumn(name="type_product_id", referencedColumnName="id")
     */
    protected $typeProduct;
    /**
     * @var TypeQuantity
     *
     * @ORM\ManyToOne(targetEntity="TypeQuantity")
     * @ORM\JoinColumn(name="type_quantity_id", referencedColumnName="id")
     */
    protected $typeQuantity;

    /**
     * Product constructor.
     *
     * @param string       $name
     * @param TypeProduct  $typeProduct
     * @param TypeQuantity $typeQuantity
     */
    public function __construct(
        string $name,
        TypeProduct $typeProduct,
        TypeQuantity $typeQuantity
    ) {
        $this->name = $name;
        $this->typeProduct = $typeProduct;
        $this->typeQuantity = $typeQuantity;
    }

    /**
     * @return TypeProduct
     */
    public function getTypeProduct(): TypeProduct
    {
        return $this->typeProduct;
    }

    /**
     * @return TypeQuantity
     */
    public function getTypeQuantity(): TypeQuantity
    {
        return $this->typeQuantity;
    }
}
