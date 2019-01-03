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

namespace App\Application\Command\GenerateUser;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class GeneratedUserInput
 */
class GeneratedUserInput implements \Serializable
{
    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Le prénom est requis."
     * )
     */
    protected $firstname;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Le nom est requis."
     * )
     */
    protected $lastname;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Le nom d'utilisateur est requis."
     * )
     */
    protected $username;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="L'adresse email est requise."
     * )
     */
    protected $email;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Le mot de passe souhaité est requis."
     * )
     */
    protected $password;

    /**
     * @var string|null
     */
    protected $roles;

    public function serialize()
    {
        return [
            $this->firstname,
            $this->lastname,
            $this->username,
            $this->email,
            $this->password,
            $this->roles
        ];
    }

    public function unserialize($serialized)
    {
        list(
            $this->firstname,
            $this->lastname,
            $this->username,
            $this->email,
            $this->password,
            $this->roles
            ) = array_values(unserialize($serialized));

        return $this;
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
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string|null
     */
    public function getRoles(): ?string
    {
        return $this->roles;
    }
}
