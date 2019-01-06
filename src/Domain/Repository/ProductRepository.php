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

        $suffixCacheKey = null;
        if (!empty($typeProducts)) {
            $qb
                ->where('p.typeProduct IN (:typeProductIds)')
                ->setParameter('typeProductIds', array_values($typeProducts));
            $suffixCacheKey = sprintf('_type_product_%s', implode('_', array_values($typeProducts)));
        }

        $key = sprintf('list_product%s', $suffixCacheKey);
        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 30, $key);

        return $query->getResult();
    }

    /**
     * @param int $id
     *
     * @return mixed
     *
     * @throws NonUniqueResultException
     */
    public function loadById(int $id)
    {
        $qb = $this->createQueryBuilder('p')
                    ->where('p.id = :id')
                    ->setParameter('id', $id);

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 30, sprintf('detail_product_id_%s', $id));

        return $query->getOneOrNullResult();
    }

}
