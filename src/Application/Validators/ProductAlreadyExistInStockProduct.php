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

namespace App\Application\Validators;

use Symfony\Component\Validator\Constraint;

/**
 * Class ProductAlreadyExistInStockProduct
 *
 * @Annotation
 */
class ProductAlreadyExistInStockProduct extends Constraint
{
    public $message = 'Ce produit est déjà présent dans votre stock.';
}
