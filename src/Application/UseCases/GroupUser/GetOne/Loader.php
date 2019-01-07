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

namespace App\Application\UseCases\GroupUser\GetOne;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\AbstractLoader;
use App\Application\UseCases\GroupUser\Output\GroupOutput;
use App\Application\UseCases\User\Output\UserOutput;
use App\Domain\Model\GroupUser;
use App\Domain\Model\User;
use App\UI\Responders\OutputInterface;

/**
 * Class Loader
 */
class Loader extends AbstractLoader
{
    /**
     * @param AbstractInput|GetOnGroupInput|null $input
     *
     * @return OutputInterface
     */
    public function load(?AbstractInput $input): OutputInterface
    {
        return $this->buildOutput($input->getGroup());
    }

    protected function getClassRepository(): string
    {
        return GroupUser::class;
    }

    private function buildOutput(GroupUser $group)
    {
        $userOutput = new UserOutput(
            $group->getOwner()->getId(),
            $group->getOwner()->getFirstname(),
            $group->getOwner()->getLastname(),
            $group->getOwner()->getRoles()
        );
        $groupOutput = new GroupOutput(
            $group->getId(),
            $group->getName(),
            $group->getSlug(),
            $userOutput
        );
        $membersGroup = $this->entityManager->getRepository(User::class)
                                            ->loadUserForGroup($group->getId());
        /** @var User $member */
        foreach ($membersGroup as $member) {
            $groupOutput->addMember(
                new UserOutput(
                    $member->getId(),
                    $member->getFirstname(),
                    $member->getLastname(),
                    $member->getRoles()
                )
            );
        }

        return $groupOutput;
    }
}
