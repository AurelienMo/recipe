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

use App\Domain\Model\User;

/**
 * Class UserBuilder
 */
class UserBuilder
{
    public static function create(
        string $firstname,
        string $lastname,
        string $username,
        string $email,
        string $password,
        ?string $role = null
    ) {
        return new User(
            $firstname,
            $lastname,
            $username,
            $email,
            $password,
            $role
        );
    }
}
