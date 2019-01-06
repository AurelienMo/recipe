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

namespace App\Application\UseCases\StockProduct\DeleteProductFromStock;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\InputInterface;
use App\Domain\Model\GroupUser;
use App\Domain\Model\StockProduct;

/**
 * Class DeleteStockProductInput
 */
class DeleteStockProductInput extends AbstractInput implements InputInterface
{
    /** @var GroupUser */
    protected $group;

    /** @var StockProduct */
    protected $stock;

    /**
     * @return GroupUser
     */
    public function getGroup(): GroupUser
    {
        return $this->group;
    }

    /**
     * @param GroupUser $group
     *
     * @return DeleteStockProductInput
     */
    public function setGroup(GroupUser $group): DeleteStockProductInput
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return StockProduct
     */
    public function getStock(): StockProduct
    {
        return $this->stock;
    }

    /**
     * @param StockProduct $stock
     *
     * @return DeleteStockProductInput
     */
    public function setStock(StockProduct $stock): DeleteStockProductInput
    {
        $this->stock = $stock;
        return $this;
    }
}
