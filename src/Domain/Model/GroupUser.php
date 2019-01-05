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

namespace App\Domain\Model;

use App\Application\Helpers\Core\Slugger;
use App\Domain\Model\Traits\NameTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

/**
 * Class GroupUser
 */
class GroupUser extends AbstractModel
{
    use NameTrait;

    /** @var string */
    protected $slug;

    /** @var User */
    protected $owner;

    /** @var User[]|Collection */
    protected $members;

    public function __construct(
        string $name,
        User $owner,
        ?array $members = []
    ) {
        $this->name = $name;
        $this->slug = Slugger::slugify($name);
        $this->owner = $owner;
        $this->members = new ArrayCollection($members);
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @return User[]|Collection
     */
    public function getMembers()
    {
        return $this->members;
    }

    /**
     * @param User $user
     *
     * @return $this
     */
    public function addMemberToGroup(User $user)
    {
        $this->members->add($user);
        $user->defineGroup($this);

        return $this;
    }
    /**
     * @param User $user
     *
     * @return $this
     */
    public function removeMemberFromGroup(User $user)
    {
        $this->members->removeElement($user);
        $user->defineGroup(null);

        return $this;
    }
}
