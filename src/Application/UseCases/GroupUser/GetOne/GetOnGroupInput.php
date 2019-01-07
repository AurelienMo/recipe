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

namespace App\Application\UseCases\GroupUser\GetOne;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\InputInterface;
use App\Domain\Model\GroupUser;

/**
 * Class GetOnGroupInput
 */
class GetOnGroupInput extends AbstractInput implements InputInterface
{
    /** @var GroupUser */
    protected $group;

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
}
