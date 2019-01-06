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

/**
 * Class TypeQuantityRepository
 */
class TypeQuantityRepository extends EntityRepository
{
    public function findByFilters(array $filters)
    {
        $qb = $this->createQueryBuilder('tp');

        $suffixCacheKey = null;
        foreach ($filters as $field => $value) {
            $qb
                ->andWhere("tp.{$field} = :value")
                ->setParameter('value', $value);
            $suffixCacheKey .= sprintf('_%s_%s', $field, $value);
        }

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(
            true,
            30,
            $suffixCacheKey ?
                sprintf('detail_type_quantity_%s', $suffixCacheKey)
                : 'detail_type_quantity'
        );

        return $query->getResult();
    }

    /**
     * @param int $id
     *
     * @return mixed
     *
     * @throws NonUniqueResultException
     */
    public function existById(int $id)
    {
        $qb = $this->createQueryBuilder('tq')
                   ->select('COUNT(tq)')
                   ->where('tq.id = :id')
                   ->setParameter('id', $id);

        $query = $qb->getQuery();
        $query->useQueryCache(true);

        return $query->getSingleScalarResult();
    }

    public function loadAllTypesQuantity()
    {
        $qb = $this->createQueryBuilder('tq');

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 30, 'list_type_quantity');

        return $query->getResult();
    }
}
