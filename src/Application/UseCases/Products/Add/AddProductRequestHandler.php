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

namespace App\Application\UseCases\Products\Add;

use App\Application\UseCases\AbstractRequestHandler;

/**
 * Class AddProductRequestHandler
 */
class AddProductRequestHandler extends AbstractRequestHandler
{
    protected function getClassInput(): string
    {
        return AddProductInput::class;
    }

    protected function havePayload(): bool
    {
        return true;
    }
}
