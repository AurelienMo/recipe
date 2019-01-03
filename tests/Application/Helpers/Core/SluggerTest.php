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

namespace App\Tests\Application\Helpers\Core;

use App\Application\Helpers\Core\Slugger;
use PHPUnit\Framework\TestCase;

/**
 * Class SluggerTest
 */
class SluggerTest extends TestCase
{
    public function testSlugifyString()
    {
        $string = 'John Doe va à la plage';

        $result = Slugger::slugify($string);
        static::assertInternalType('string', $result);
        static::assertEquals('john-doe-va-a-la-plage', $result);
    }
}
