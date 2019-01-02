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

namespace App\Application\UseCases\Products\Update;

use App\Application\UseCases\InputInterface;
use App\Application\Validators\ProductNotExist;
use App\Application\Validators\TypeProductExist;
use App\Application\Validators\TypeQuantityExist;
use App\Application\Validators\UniqueEntityInput;
use App\Domain\Model\Product;
use App\Domain\Model\TypeProduct;
use App\Domain\Model\TypeQuantity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UpdateProductInput
 */
class UpdateProductInput implements InputInterface
{
    /**
     * Product's name to update
     *
     * @var string|null
     */
    protected $name;

    /**
     * Unique identifier of product type
     *
     * @var int|null
     *
     * @TypeProductExist()
     */
    protected $typeProduct;

    /**
     * Unique identifier of type quantity
     *
     * @var int|null
     *
     * @TypeQuantityExist()
     */
    protected $typeQuantity;

    /**
     * @var int
     *
     * @Assert\NotBlank(
     *     message="Vous devez spécifier l'identifiant du produit."
     * )
     * @ProductNotExist()
     */
    protected $productId;

    /**
     * @var Product
     */
    protected $product;

    /**
     * @var TypeProduct
     */
    protected $typeProductObject;

    /**
     * @var TypeQuantity
     */
    protected $typeQuantityObject;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getTypeProduct(): ?int
    {
        return $this->typeProduct;
    }

    /**
     * @param int|null $typeProduct
     */
    public function setTypeProduct(?int $typeProduct): void
    {
        $this->typeProduct = $typeProduct;
    }

    /**
     * @return int|null
     */
    public function getTypeQuantity(): ?int
    {
        return $this->typeQuantity;
    }

    /**
     * @param int|null $typeQuantity
     */
    public function setTypeQuantity(?int $typeQuantity): void
    {
        $this->typeQuantity = $typeQuantity;
    }

    /**
     * @return int
     */
    public function getProductId(): int
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    /**
     * @return TypeProduct
     */
    public function getTypeProductObject(): ?TypeProduct
    {
        return $this->typeProductObject;
    }

    /**
     * @param TypeProduct $typeProductObject
     */
    public function setTypeProductObject(TypeProduct $typeProductObject): void
    {
        $this->typeProductObject = $typeProductObject;
    }

    /**
     * @return TypeQuantity
     */
    public function getTypeQuantityObject(): ?TypeQuantity
    {
        return $this->typeQuantityObject;
    }

    /**
     * @param TypeQuantity $typeQuantityObject
     */
    public function setTypeQuantityObject(TypeQuantity $typeQuantityObject): void
    {
        $this->typeQuantityObject = $typeQuantityObject;
    }
}
