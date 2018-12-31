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

namespace App\Application\Helpers\Core;

use App\Application\Exceptions\ValidatorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ErrorsBuilder
 */
class ErrorsBuilder
{
    /**
     * Build errors violations
     *
     * @param ConstraintViolationListInterface $constraintViolationList
     *
     * @throws ValidatorException
     */
    public static function buildErrors(ConstraintViolationListInterface $constraintViolationList)
    {
        $errors = [];
        /** @var ConstraintViolationInterface $constraint */
        foreach ($constraintViolationList as $constraint) {
            $errors[$constraint->getPropertyPath()][] = $constraint->getMessage();
        }

        throw new ValidatorException(
            Response::HTTP_BAD_REQUEST,
            $errors
        );
    }
}
