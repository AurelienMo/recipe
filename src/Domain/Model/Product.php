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

use App\Application\Helpers\Core\Slugger;
use App\Application\UseCases\Products\Update\UpdateProductInput;
use App\Domain\Model\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Product
 */
class Product extends AbstractModel
{
    use NameTrait;

    /** @var TypeProduct */
    protected $typeProduct;

    /** @var TypeQuantity */
    protected $typeQuantity;

    /** @var string */
    protected $slug;

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
        $this->slug = Slugger::slugify($name);
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

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param UpdateProductInput $input
     *
     * @return bool
     */
    public function updateDatas(UpdateProductInput $input)
    {
        $isUpdated = false;
        if ($input->getName() && $input->getName() !== $this->name) {
            $this->name = $input->getName();
            $this->slug = Slugger::slugify($input->getName());
            $isUpdated = true;
        }
        if ($input->getTypeProductObject() && $input->getTypeProductObject() !== $this->getTypeProduct()) {
            $this->typeProduct = $input->getTypeProductObject();
            $isUpdated = true;
        }
        if ($input->getTypeQuantityObject() && $input->getTypeQuantityObject() !== $this->getTypeQuantity()) {
            $this->typeQuantity = $input->getTypeQuantityObject();
            $isUpdated = true;
        }

        return $isUpdated;
    }
}
