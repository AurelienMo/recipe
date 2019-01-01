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

namespace App\Application\UseCases\Products\Add\Output;

use App\UI\Responders\OutputInterface;

/**
 * Class AddProductOutput
 */
class AddProductOutput implements OutputInterface
{
    /**
     * Unique identifier of product
     *
     * @var int
     */
    protected $id;

    /**
     * Product Name
     *
     * @var string
     */
    protected $name;

    /**
     * Product's slug.
     *
     * @var string
     */
    protected $slug;

    /**
     * Unique identifier of product's type
     *
     * @var int
     */
    protected $typeProduct;

    /**
     * Unique identifier of product's type quantity
     *
     * @var int
     */
    protected $typeQuantity;

    /**
     * AddProductOutput constructor.
     *
     * @param int    $id
     * @param string $name
     * @param string $slug
     * @param int    $typeProduct
     * @param int    $typeQuantity
     */
    public function __construct(
        $id,
        string $name,
        string $slug,
        int $typeProduct,
        int $typeQuantity
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->typeProduct = $typeProduct;
        $this->typeQuantity = $typeQuantity;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getTypeProduct(): int
    {
        return $this->typeProduct;
    }

    /**
     * @return int
     */
    public function getTypeQuantity(): int
    {
        return $this->typeQuantity;
    }
}
