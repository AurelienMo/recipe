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
 * Class ProductRecipe
 *
 * @ORM\Table(name="amo_product_recipe")
 * @ORM\Entity()
 */
class ProductRecipe extends AbstractModel
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
     * @var Recipe
     *
     * @ORM\ManyToOne(targetEntity="Recipe")
     * @ORM\JoinColumn(name="recipe_id", referencedColumnName="id")
     */
    protected $recipe;

    /**
     * ProductRecipe constructor.
     *
     * @param int          $quantity
     * @param TypeQuantity $typeQuantity
     * @param Product      $product
     * @param Recipe       $recipe
     */
    public function __construct(
        int $quantity,
        TypeQuantity $typeQuantity,
        Product $product,
        Recipe $recipe
    ) {
        $this->quantity = $quantity;
        $this->typeQuantity = $typeQuantity;
        $this->product = $product;
        $this->recipe = $recipe;
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

    /**
     * @return Recipe
     */
    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }
}
