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

use App\Domain\Model\Product;
use App\Domain\Model\TypeProduct;
use App\Domain\Model\TypeQuantity;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ProductNotExistValidator
 */
class ProductNotExistValidator extends ConstraintValidator
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /**
     * ProductNotExistValidator constructor.
     *
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
    }

    /**
     * @param mixed      $value
     * @param Constraint $constraint
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function validate(
        $value,
        Constraint $constraint
    ) {
        $product = $this->entityManager->getRepository(Product::class)
                                       ->loadById($value);

        if (is_null($product)) {
            $this->context->buildViolation($constraint->message)
                          ->addViolation();
        }

    }
}
