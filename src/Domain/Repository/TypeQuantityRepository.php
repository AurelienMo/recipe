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
 * Class TypeQuantityRepository
 */
class TypeQuantityRepository extends EntityRepository
{
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
}
