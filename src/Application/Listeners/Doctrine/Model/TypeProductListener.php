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

use App\Domain\Model\TypeProduct;

/**
 * Class TypeProductListener
 */
class TypeProductListener extends AbstractModelListener
{
    public function getCacheKeys(): array
    {
        return [
            'list_type_product',
            'detail_type_product_'
        ];
    }

    protected function getClassName(): string
    {
        return TypeProduct::class;
    }
}
