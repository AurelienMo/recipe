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

namespace App\Application\Listeners\Doctrine\Model;

use App\Domain\Model\TypeQuantity;

/**
 * Class TypeQuantityListener
 */
class TypeQuantityListener extends AbstractModelListener
{
    public function getCacheKeys(): array
    {
        return [
            'detail_type_quantity_',
        ];
    }

    protected function getClassName(): string
    {
        return TypeQuantity::class;
    }
}
