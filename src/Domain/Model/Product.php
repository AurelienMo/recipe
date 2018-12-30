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
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 *
 * @ORM\Table(name="amo_product")
 * @ORM\Entity()
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
     * @var Recipe[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="Recipe", mappedBy="products")
     */
    protected $recipes;

    /**
     * Product constructor.
     *
     * @param string      $name
     * @param TypeProduct $typeProduct
     */
    public function __construct(
        string $name,
        TypeProduct $typeProduct
    ) {
        $this->name = $name;
        $this->typeProduct = $typeProduct;
        $this->recipes = new ArrayCollection();
    }

    /**
     * @return TypeProduct
     */
    public function getTypeProduct(): TypeProduct
    {
        return $this->typeProduct;
    }

    /**
     * @return Recipe[]|Collection
     */
    public function getRecipes()
    {
        return $this->recipes;
    }

    /**
     * @param Recipe $recipe
     *
     * @return $this
     */
    public function addRecipeWithProduct(Recipe $recipe)
    {
        $this->recipes->add($recipe);

        return $this;
    }

    /**
     * @param Recipe $recipe
     */
    public function removeRecipeWithProduct(Recipe $recipe)
    {
        $this->recipes->removeElement($recipe);
    }


}
