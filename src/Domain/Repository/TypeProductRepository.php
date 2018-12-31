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
 * Class TypeProductRepository
 */
class TypeProductRepository extends EntityRepository
{
    public function loadAllTypesProduct()
    {
        return $this->createQueryBuilder('tp')
                    ->setCacheable(true)
                    ->getQuery()
                    ->getResult();
    }
}
