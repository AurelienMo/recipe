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

use App\Domain\Model\TypeQuantity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class TypeQuantityExistValidator
 */
class TypeQuantityExistValidator extends ConstraintValidator
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * TypeQuantityExistValidator constructor.
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
            $typeQuantity = $this->entityManager->getRepository(TypeQuantity::class)
                                                ->findByFilters(
                                                    [
                                                        'id' => $value,
                                                    ]
                                                );

            if (empty($typeQuantity)) {
                $this->context->buildViolation($constraint->message)
                              ->addViolation();
            }
        }
    }

}
