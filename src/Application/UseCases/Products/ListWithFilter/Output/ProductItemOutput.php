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

namespace App\Application\UseCases\Products\ListWithFilter\Output;

/**
 * Class ProductItemOutput
 */
class ProductItemOutput
{
    /**
     * Unique identifier of product
     *
     * @var int
     */
    protected $id;

    /**
     * Name of product
     *
     * @var string
     */
    protected $name;

    /**
     * Unique identifier of type of product
     *
     * @var int
     */
    protected $typeProduct;

    /**
     * ProductItemOutput constructor.
     *
     * @param int    $id
     * @param string $name
     * @param int    $typeProduct
     */
    public function __construct(
        int $id,
        string $name,
        int $typeProduct
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->typeProduct = $typeProduct;
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
     * @return int
     */
    public function getTypeProduct(): int
    {
        return $this->typeProduct;
    }
}
