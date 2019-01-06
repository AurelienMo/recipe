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
 * Class GroupUserRepository
 */
class GroupUserRepository extends EntityRepository
{
    /**
     * @param int $id
     *
     * @return mixed
     *
     * @throws NonUniqueResultException
     */
    public function loadById(int $id)
    {
        $qb = $this->createQueryBuilder('gu')
                   ->where('gu.id = :id')
                   ->setParameter('id', $id);

        $query = $qb->getQuery();
        $query->useQueryCache(true);
        $query->useResultCache(true, 3600, sprintf('detail_group_%s', $id));

        return $query->getOneOrNullResult();
    }
}
