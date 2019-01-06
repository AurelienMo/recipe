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

use App\Domain\Model\StockProduct;
use App\Domain\Model\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class StockProductVoter
 */
class StockProductVoter extends Voter
{
    /** @var Security */
    private $security;

    /**
     * StockProductVoter constructor.
     *
     * @param Security $security
     */
    public function __construct(
        Security $security
    ) {
        $this->security = $security;
    }

    const LIST_ATTRIBUTES = [
        'edit',
        'delete',
        'deleteUser'
    ];

    protected function supports(
        $attribute,
        $subject
    ) {
        if (!in_array($attribute, self::LIST_ATTRIBUTES)) {
            return false;
        }

        if (!$subject instanceof StockProduct) {
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

    private function canEdit(StockProduct $stock, User $user)
    {
        return $stock->getGroup() === $user->getGroup();
    }

    private function canDelete(StockProduct $stock, User $user)
    {
        return $this->security->isGranted('ROLE_GROUP_MODERATOR');
    }

    private function canDeleteUser(StockProduct $stock, User $user)
    {
        return $stock->getGroup() === $user->getGroup();
    }
}
