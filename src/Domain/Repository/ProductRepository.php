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

namespace App\Domain\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class ProductRepository
 */
class ProductRepository extends EntityRepository
{
    /**
     * @param array|null $typeProducts
     *
     * @return mixed
     */
    public function loadProductsAccordingParameter(?array $typeProducts)
    {
        $query = $this->createQueryBuilder('p');

        if (!empty($typeProducts)) {
            $query
                ->where('p.typeProduct IN (:typeProductIds)')
                ->setParameter('typeProductIds', array_values($typeProducts));
        }

        return $query->getQuery()->getResult();
    }
}
