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

namespace App\Application\UseCases\StockProduct\ListStock;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\InputInterface;
use App\Domain\Model\GroupUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ListStockInput
 */
class ListStockInput extends AbstractInput implements InputInterface
{
    /**
     * @var GroupUser
     *
     * @Assert\NotBlank(
     *     message="Le groupe d'utilisateurs concerné ne peut être vide."
     * )
     */
    protected $group;

    /**
     * @var string[]|null
     */
    protected $typeProducts;

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
     * @return string[]
     */
    public function getTypeProducts(): ?array
    {
        return $this->typeProducts;
    }

    /**
     * @param string[] $typeProducts
     */
    public function setTypeProducts(?array $typeProducts): void
    {
        $this->typeProducts = $typeProducts;
    }
}
