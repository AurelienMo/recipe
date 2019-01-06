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

namespace App\Application\UseCases\StockProduct\Output;

use App\Application\UseCases\Products\Add\Output\AddProductOutput;
use App\UI\Responders\OutputInterface;

/**
 * Class StockItemOutput
 */
class StockItemOutput implements OutputInterface
{
    /** @var int */
    protected $id;

    /** @var AddProductOutput */
    protected $product;

    /** @var float */
    protected $quantity;

    /**
     * StockItemOutput constructor.
     *
     * @param int              $id
     * @param AddProductOutput $product
     * @param float            $quantity
     */
    public function __construct(
        int $id,
        AddProductOutput $product,
        float $quantity
    ) {
        $this->id = $id;
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return AddProductOutput
     */
    public function getProduct(): AddProductOutput
    {
        return $this->product;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }
}
