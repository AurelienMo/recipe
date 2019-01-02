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

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 */
class User extends AbstractModel implements UserInterface
{
    /** @var string */
    protected $firstname;

    /** @var string */
    protected $lastname;

    /** @var string */
    protected $username;

    /** @var string */
    protected $email;

    /** @var string */
    protected $password;

    /** @var array */
    protected $roles;

    /** @var GroupUser|null */
    protected $group;

    /**
     * User constructor.
     *
     * @param string $firstname
     * @param string $lastname
     * @param string $username
     * @param string $email
     * @param string $password
     */
    public function __construct(
        string $firstname,
        string $lastname,
        string $username,
        string $email,
        string $password
    ) {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->roles[] = 'ROLE_USER';
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function eraseCredentials()
    {
        return;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return GroupUser|null
     */
    public function getGroup(): ?GroupUser
    {
        return $this->group;
    }

    /**
     * @param GroupUser|null $group
     */
    public function defineGroup(?GroupUser $group)
    {
        $this->group = $group;
    }
}
