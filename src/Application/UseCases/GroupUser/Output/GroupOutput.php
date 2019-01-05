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

namespace App\Application\UseCases\GroupUser\Output;

use App\Application\UseCases\User\Output\UserOutput;
use App\UI\Responders\OutputInterface;

/**
 * Class GroupOutput
 */
class GroupOutput implements OutputInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $name;

    /** @var string */
    protected $slug;

    /** @var UserOutput */
    protected $owner;

    /** @var UserOutput[] */
    protected $members;

    /**
     * GroupOutput constructor.
     *
     * @param int        $id
     * @param string     $name
     * @param string     $slug
     * @param UserOutput $owner
     */
    public function __construct(
        int $id,
        string $name,
        string $slug,
        UserOutput $owner
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->slug = $slug;
        $this->owner = $owner;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return UserOutput
     */
    public function getOwner(): UserOutput
    {
        return $this->owner;
    }

    /**
     * @return UserOutput[]
     */
    public function getMembers(): array
    {
        return $this->members;
    }

    public function addMember(UserOutput $userOutput)
    {
        $this->members[] = $userOutput;
    }
}
