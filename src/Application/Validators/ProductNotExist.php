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
 * Class ProductNotExist
 *
 * @Annotation
 */
class ProductNotExist extends Constraint
{
    public $message = 'Le produit demandé n\'existe pas.';
}
