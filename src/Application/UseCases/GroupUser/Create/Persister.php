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

use App\Application\Helpers\Core\ListRoles;
use App\Application\UseCases\AbstractPersister;
use App\Application\UseCases\GroupUser\Output\GroupOutput;
use App\Application\UseCases\InputInterface;
use App\Application\UseCases\User\Output\UserOutput;
use App\Domain\Builders\GroupUserBuilder;
use App\Domain\Model\GroupUser;
use App\UI\Responders\OutputInterface;

/**
 * Class Persister
 */
class Persister extends AbstractPersister
{
    /**
     * @param InputInterface|AddGroupInput $input
     *
     * @return OutputInterface|null
     */
    public function save(InputInterface $input): ?OutputInterface
    {
        $group = GroupUserBuilder::create(
            $input->getName(),
            $input->getOwner()
        );
        $group->addMemberToGroup($input->getOwner());
        $input->getOwner()->defineRole(ListRoles::ROLE_GROUP_OWNER);

        $this->entityManager->persist($group);
        $this->entityManager->flush();

        return $this->buildOutput($group, $input);
    }

    protected function getClassRepository(): string
    {
        return GroupUser::class;
    }

    /**
     * @param GroupUser     $group
     * @param AddGroupInput $input
     *
     * @return GroupOutput
     */
    private function buildOutput(GroupUser $group, AddGroupInput $input)
    {
        $userOutput = new UserOutput(
            $input->getOwner()->getId(),
            $input->getOwner()->getFirstname(),
            $input->getOwner()->getLastname(),
            $input->getOwner()->getRoles()
        );
        $groupOutput = new GroupOutput(
            $group->getId(),
            $group->getName(),
            $group->getSlug(),
            $userOutput
        );
        $groupOutput->addMember($userOutput);

        return $groupOutput;
    }
}
