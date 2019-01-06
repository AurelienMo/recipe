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

use App\Domain\Model\GroupUser;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * Class StockProductRepository
 */
class StockProductRepository extends EntityRepository
{
    /**
     * Return list stock product for a given group with related product's type if filter is define
     *
     * @param GroupUser  $groupUser
     * @param array|null $typeProducts
     *
     * @return array
     */
    public function loadStock(GroupUser $groupUser, ?array $typeProducts)
    {
        $qb = $this->createQueryBuilder('sp')
                   ->innerJoin('sp.product', 'p', 'WITH', 'p.id = sp.product')
                   ->where('sp.group = :groupId')
                   ->setParameter('groupId', $groupUser);

        if (!empty($typeProducts) && !is_null($typeProducts)) {
            $qb->andWhere('p.typeProduct IN (:typeProductIds)')
                ->setParameter('typeProductIds', array_values($typeProducts));
        }

        $query = $qb->getQuery();
        $query->useQueryCache(true);

        return $query->getResult();
    }

    /**
     * @param int $id
     *
     * @return mixed
     *
     * @throws NonUniqueResultException
     */
    public function loadStockById(int $id)
    {
        $qb = $this->createQueryBuilder('sp')
                   ->where('sp.id = :id');

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 30, sprintf('detail_stock_product_%s', $id));

        return $query->getOneOrNullResult();
    }

    public function stockGroupHasProduct(GroupUser $groupUser, int $product)
    {
        $query = $this->createQueryBuilder('sp')
                      ->where('sp.product = :productId')
                      ->andWhere('sp.group = :group')
                      ->setParameters(
                          [
                              'productId' => $product,
                              'group' => $groupUser
                          ]
                      )
                      ->getQuery()
                      ->getScalarResult();

        return 1 === (int) $query;
    }
}
