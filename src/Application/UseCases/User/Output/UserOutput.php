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

namespace App\Application\UseCases\User\Output;

use App\UI\Responders\OutputInterface;

/**
 * Class UserOutput
 */
class UserOutput implements OutputInterface
{
    /** @var int */
    protected $id;

    /** @var string */
    protected $firstname;

    /** @var string */
    protected $lastname;

    /** @var array */
    protected $roles;

    /**
     * UserOutput constructor.
     *
     * @param int    $id
     * @param string $firstname
     * @param string $lastname
     * @param array  $roles
     */
    public function __construct(
        int $id,
        string $firstname,
        string $lastname,
        array $roles
    ) {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->roles = $roles;
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
     * @return array
     */
    public function getRoles(): array
    {
        return $this->roles;
    }
}
