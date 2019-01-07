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
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 */
class UserRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * @param string $value
     *
     * @return mixed|UserInterface|null
     *
     * @throws NonUniqueResultException
     */
    public function loadUserByUsername($value)
    {
        $qb = $this->createQueryBuilder('u')
                    ->where('u.username = :username OR u.email = :email')
                    ->setParameters(
                        [
                            'username' => $value,
                            'email' => $value,
                        ]
                    );

        $query = $qb->getQuery();
        $query->useQueryCache(true);

        return $query->getOneOrNullResult();
    }

    /**
     * @param int $groupId
     *
     * @return mixed
     */
    public function loadUserForGroup(int $groupId)
    {
        $qb = $this->createQueryBuilder('u')
                   ->where('u.group = :groupId')
                   ->setParameter('groupId', $groupId);

        $query = $qb->getQuery();
        $query->useQueryCache(true);

        return $query->getResult();
    }
}
