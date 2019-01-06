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

namespace App\Application\UseCases\StockProduct\UpdateStock;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\InputInterface;
use App\Domain\Model\GroupUser;
use App\Domain\Model\StockProduct;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class UpdateStockProductInput
 */
class UpdateStockProductInput extends AbstractInput implements InputInterface
{
    /**
     * @var GroupUser
     */
    protected $group;

    /**
     * @var StockProduct
     */
    protected $stock;

    /**
     * @var float|null
     *
     * @Assert\NotBlank(
     *     message="La quantité doit être spécifiée."
     * )
     */
    protected $quantity;

    /**
     * @return GroupUser
     */
    public function getGroup(): GroupUser
    {
        return $this->group;
    }

    /**
     * @param GroupUser $group
     */
    public function setGroup(GroupUser $group): void
    {
        $this->group = $group;
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
     */
    public function setStock(StockProduct $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return float|null
     */
    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(?float $quantity): void
    {
        $this->quantity = $quantity;
    }
}
