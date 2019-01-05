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

namespace App\Application\Helpers\Core;

/**
 * Class ListRoles
 */
class ListRoles
{
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';
    const ROLE_GROUP_OWNER = 'ROLE_GROUP_OWNER';
    const ROLE_USER = 'ROLE_USER';
    const ROLE_GROUP_MEMBER = 'ROLE_GROUP_MEMBER';
    const ROLE_GROUP_MODERATOR = 'ROLE_GROUP_MODERATOR';
}
