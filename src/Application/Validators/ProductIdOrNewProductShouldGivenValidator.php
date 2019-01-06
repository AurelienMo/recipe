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
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ProductIdOrNewProductShouldGivenValidator
 */
class ProductIdOrNewProductShouldGivenValidator extends ConstraintValidator
{
    public function validate(
        $value,
        Constraint $constraint
    ) {
        if (is_null($value->getProductId()) && (is_null($value->getProduct()))) {
            $this->context->buildViolation($constraint->message)
                          ->addViolation();
        }
    }
}
