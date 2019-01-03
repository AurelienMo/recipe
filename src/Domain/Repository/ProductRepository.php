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
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

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
        $qb = $this->createQueryBuilder('p');

        if (!empty($typeProducts)) {
            $qb
                ->where('p.typeProduct IN (:typeProductIds)')
                ->setParameter('typeProductIds', array_values($typeProducts));
        }

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 30);

        return $query->getResult();
    }

    /**
     * @param int $id
     *
     * @return mixed
     * @throws NonUniqueResultException
     */
    public function loadById(int $id)
    {
        return $this->createQueryBuilder('p')
                    ->where('p.id = :id')
                    ->setParameter('id', $id)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

}
