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

namespace App\Tests\Domain\Builders;

use App\Domain\Builders\UserBuilder;
use App\Domain\Model\GroupUser;
use App\Domain\Model\User;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

/**
 * Class UserBuilderTest
 */
class UserBuilderTest extends TestCase
{
    public function testMethodCreate()
    {
        $user = UserBuilder::create(
            'John',
            'Doe',
            'johndoe',
            'johndoe@yopmail.com',
            '12345678'
        );

        static::assertInstanceOf(User::class, $user);
    }
}
