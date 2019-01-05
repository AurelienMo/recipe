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

namespace App\Application\UseCases\GroupUser\Create;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\InputInterface;
use App\Application\Validators\UniqueEntityInput;
use App\Application\Validators\UserNotHaveOtherGroup;
use App\Domain\Model\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AddGroupInput
 *
 * @UniqueEntityInput(
 *     class="App\Domain\Model\GroupUser",
 *     fields={"name", "slug"},
 *     message="Ce nom de groupe est indisponible."
 * )
 */
class AddGroupInput extends AbstractInput implements InputInterface
{
    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Le nom du groupe est requis."
     * )
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var User
     *
     * @UserNotHaveOtherGroup()
     */
    protected $owner;

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return User
     */
    public function getOwner(): User
    {
        return $this->owner;
    }

    /**
     * @param User $owner
     */
    public function setOwner(User $owner): void
    {
        $this->owner = $owner;
    }

    /**
     * @return string
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     */
    public function setSlug(?string $slug): void
    {
        $this->slug = $slug;
    }
}
