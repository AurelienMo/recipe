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

use App\Application\Helpers\Core\ListErrorsAuthorization;
use App\Application\UseCases\AbstractRequestHandler;
use App\Application\UseCases\InputInterface;
use App\Domain\Model\GroupUser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class GetOneGroupRequestHandler
 */
class GetOneGroupRequestHandler extends AbstractRequestHandler
{
    /** @var EntityManagerInterface */
    private $entityManager;

    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage,
        AuthorizationCheckerInterface $authorizationChecker,
        EntityManagerInterface $entityManager
    ) {
        $this->entityManager = $entityManager;
        parent::__construct(
            $serializer,
            $validator,
            $tokenStorage,
            $authorizationChecker
        );
    }

    /**
     * @param Request $request
     *
     * @return InputInterface|GetOnGroupInput
     */
    public function handle(Request $request): InputInterface
    {
        $group = $this->checkExistGroup($request);
        $this->checkAuthorization('access', $group, ListErrorsAuthorization::ERROR_ACCESS_GROUP);

        $input = $this->instanciateInputClass();
        $input->setGroup($group);

        return $input;
    }

    protected function getClassInput(): string
    {
        return GetOnGroupInput::class;
    }

    protected function havePayload(): bool
    {
        return false;
    }

    private function checkExistGroup(Request $request)
    {
        $group = $this->entityManager->getRepository(GroupUser::class)
                                     ->find((int) $request->attributes->get('groupId'));

        if (is_null($group)) {
            throw new HttpException(
                Response::HTTP_NOT_FOUND,
                'Le groupe n\'existe pas.'
            );
        }

        return $group;
    }
}
