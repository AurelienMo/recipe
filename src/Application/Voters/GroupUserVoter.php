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

namespace App\Application\Voters;

use App\Domain\Model\GroupUser;
use App\Domain\Model\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class GroupUserVoter
 */
class GroupUserVoter extends Voter
{
    const LIST_ATTRIBUTES = [
        'access'
    ];

    protected function supports(
        $attribute,
        $subject
    ) {
        if (!in_array($attribute, self::LIST_ATTRIBUTES)) {
            return false;
        }

        if (!$subject instanceof GroupUser) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute(
        $attribute,
        $subject,
        TokenInterface $token
    ) {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        return $this->{'can'.ucfirst($attribute)}($subject, $user);
    }

    private function canAccess(GroupUser $group, User $user)
    {
        return $group === $user->getGroup();
    }
}
