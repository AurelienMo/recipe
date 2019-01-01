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
 * Class TypeProductExist
 *
 * @Annotation
 */
class TypeProductExist extends Constraint
{
    public $message = 'Cette catégorie de produit n\'existe pas.';
}
