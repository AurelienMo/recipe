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

namespace App\UI\Actions\API\Group;

use App\Application\Exceptions\ValidatorException;
use App\Application\UseCases\GroupUser\Create\CreateGroupRequestHandler;
use App\Application\UseCases\GroupUser\Create\Persister;
use App\UI\Actions\API\AbstractApiResponder;
use App\UI\Responders\JsonResponder;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CreateGroup
 */
class CreateGroup extends AbstractApiResponder
{
    /** @var CreateGroupRequestHandler */
    private $requestHandler;

    /** @var Persister */
    private $persister;

    public function __construct(
        JsonResponder $responder,
        CreateGroupRequestHandler $requestHandler,
        Persister $persister
    ) {
        $this->requestHandler = $requestHandler;
        $this->persister = $persister;
        parent::__construct($responder);
    }

    /**
     * @Route("/groups", name="create_group_user", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws ValidatorException
     * @throws \ReflectionException
     *
     * @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Datas group to create group into database",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/AddGroupInput")
     * )
     * @SWG\Response(
     *     response="201",
     *     description="Successful creation group",
     *     @SWG\Schema(ref="#/definitions/GroupOutput")
     * )
     * @SWG\Response(
     *     response="400",
     *     description="Bad request. please check your request"
     * )
     * @SWG\Response(
     *     response="403",
     *     description="Forbidden access."
     * )
     * @SWG\Tag(name="Group")
     * @Security(name="Bearer")
     */
    public function create(Request $request)
    {
        $input = $this->requestHandler->handle($request);
        $output = $this->persister->save($input);

        return $this->sendResponse($output, Response::HTTP_CREATED);
    }
}
