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

use App\Domain\Model\GroupUser;
use App\Domain\Model\StockProduct;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/**
 * Class ProductAlreadyExistInStockProductValidator
 */
class ProductAlreadyExistInStockProductValidator extends ConstraintValidator
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /**
     * ProductAlreadyExistInStockProductValidator constructor.
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
        if (is_null($value)) {
            return;
        }

        /** @var GroupUser $group */
        $group = $this->context->getObject()->getGroup();
        if ($this->entityManager->getRepository(StockProduct::class)->stockGroupHasProduct($group, $value)) {
            $this->context->buildViolation($constraint->message)
                          ->addViolation();
        }
    }
}