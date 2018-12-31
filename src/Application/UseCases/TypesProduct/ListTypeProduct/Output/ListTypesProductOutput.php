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

namespace App\Application\UseCases\TypesProduct\ListTypeProduct\Output;

use App\UI\Responders\OutputInterface;

/**
 * Class ListTypesProductOutput
 */
class ListTypesProductOutput implements OutputInterface
{
    /**
     * @var TypeProductItemOutput[]
     */
    protected $typesProduct = [];

    /**
     * @return TypeProductItemOutput[]
     */
    public function getTypesProduct(): array
    {
        return $this->typesProduct;
    }

    public function addTypeProduct(TypeProductItemOutput $typeProduct)
    {
        $this->typesProduct[] = $typeProduct;
    }
}
