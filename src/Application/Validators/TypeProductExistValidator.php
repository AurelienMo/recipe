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

use App\Domain\Model\TypeProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class TypeProductExistValidator
 */
class TypeProductExistValidator extends ConstraintValidator
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * TypeProductExistValidator constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    public function validate(
        $value,
        Constraint $constraint
    ) {
        if (!\is_null($value)) {
            $typeProduct = $this->entityManager->getRepository(TypeProduct::class)
                                               ->existById($value);
            if (empty($typeProduct)) {
                $this->context->buildViolation($constraint->message)
                              ->addViolation();
            }
        }
    }
}
