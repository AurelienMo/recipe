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

use Doctrine\DBAL\FetchMode;
use Doctrine\ORM\EntityRepository;

/**
 * Class TypeProductRepository
 */
class TypeProductRepository extends EntityRepository
{
    public function loadAllTypesProduct()
    {
        $qb = $this->createQueryBuilder('tp');

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 3600, 'list_type_product');

        return $query->getResult();
    }


    public function findByFilters(array $filters)
    {
        $query = $this->createQueryBuilder('tp');

        foreach ($filters as $field => $value) {
            $query
                ->andWhere("tp.{$field} = :value")
                ->setParameter('value', $value);
        }

        return $query->getQuery()->getResult();
    }

    /**
     * @param int $id
     *
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function existById(int $id)
    {
        $qb = $this->createQueryBuilder('tp')
            ->select('COUNT(tp)')
            ->where('tp.id = :id')
            ->setParameter('id', $id);

        $query = $qb->getQuery();
        $query->useQueryCache(true);

        return $query->getSingleScalarResult();
    }
}
