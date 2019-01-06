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

use App\UI\Responders\OutputInterface;

/**
 * Class StockOutput
 */
class StockOutput implements OutputInterface
{
    /** @var StockItemOutput[] */
    protected $items = [];

    /**
     * @return StockItemOutput[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param StockItemOutput $stockItemOutput
     */
    public function addItem(StockItemOutput $stockItemOutput)
    {
        $this->items[] = $stockItemOutput;
    }
}
