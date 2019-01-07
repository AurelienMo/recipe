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
use App\Application\UseCases\GroupUser\GetOne\GetOneGroupRequestHandler;
use App\Application\UseCases\GroupUser\GetOne\Loader;
use App\UI\Actions\API\AbstractApiResponder;
use App\UI\Responders\JsonResponder;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class GetGroup
 */
class GetGroup extends AbstractApiResponder
{
    /** @var GetOneGroupRequestHandler */
    private $requestHandler;

    /** @var Loader */
    private $loader;

    public function __construct(
        JsonResponder $responder,
        GetOneGroupRequestHandler $requestHandler,
        Loader $loader
    ) {
        $this->requestHandler = $requestHandler;
        $this->loader = $loader;
        parent::__construct($responder);
    }

    /**
     * Obtain group informations according parameters
     *
     * @Route("/groups/{groupId}", name="get_group_information", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws ValidatorException
     * @throws \ReflectionException
     *
     * @SWG\Parameter(
     *     in="path",
     *     name="groupId",
     *     type="integer",
     *     required=true,
     *     description="Group Id targeted to update stock product"
     * )
     * @SWG\Response(
     *     response="200",
     *     description="Successfull obtain group informations",
     *     @SWG\Schema(ref="#/definitions/GroupOutput")
     * )
     * @SWG\Response(
     *     response="401",
     *     description="Unauthorized, please connect to your account"
     * )
     * @SWG\Response(
     *     response="403",
     *     description="Forbidden, you are not allowed to access this informations"
     * )
     * @SWG\Response(
     *     response="404",
     *     description="Group not found."
     * )
     * @SWG\Tag(name="Group")
     * @Security(name="Bearer")
     */
    public function show(Request $request)
    {
        $input = $this->requestHandler->handle($request);
        $output = $this->loader->load($input);

        return $this->sendResponse($output);
    }
}
