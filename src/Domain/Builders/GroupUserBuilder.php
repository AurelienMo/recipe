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

namespace App\Domain\Builders;

use App\Domain\Model\GroupUser;
use App\Domain\Model\User;

/**
 * Class GroupUserBuilder
 */
class GroupUserBuilder
{
    public static function create(
        string $name,
        User $owner
    ) {
        return new GroupUser(
            $name,
            $owner
        );
    }
}
