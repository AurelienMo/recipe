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

namespace App\UI\Actions\API\Products;

use App\Application\Exceptions\ValidatorException;
use App\Application\UseCases\Products\ListWithFilter\ListRequestHandler;
use App\Application\UseCases\Products\ListWithFilter\Loader;
use App\UI\Actions\API\AbstractApiResponder;
use App\UI\Responders\JsonResponder;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListProduct
 */
class ListProduct extends AbstractApiResponder
{
    /** @var ListRequestHandler */
    protected $requestHandler;

    /** @var Loader */
    protected $loader;

    /**
     * ListProduct constructor.
     *
     * @param JsonResponder      $responder
     * @param ListRequestHandler $requestHandler
     * @param Loader             $loader
     */
    public function __construct(
        JsonResponder $responder,
        ListRequestHandler $requestHandler,
        Loader $loader
    ) {
        $this->requestHandler = $requestHandler;
        $this->loader = $loader;
        parent::__construct($responder);
    }

    /**
     * List products according type product filter if filter given
     *
     * @Route("/products", name="list_products", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws \ReflectionException
     * @throws ValidatorException
     *
     * @SWG\Parameter(
     *     name="lang",
     *     type="string",
     *     in="query",
     *     description="Targeted language. `fr` or `en` allowed",
     *     required=true
     * )
     * @SWG\Parameter(
     *     name="typesProduct",
     *     type="string",
     *     in="query",
     *     description="Targeted filter by type of product",
     *     required=false
     * )
     * @SWG\Response(
     *     response="200",
     *     description="Successful response. Obtain List product",
     *     @SWG\Schema(
     *         ref="#/definitions/ListProductOutput"
     *     )
     * )
     * @SWG\Response(
     *     response="204",
     *     description="No content found"
     * )
     * @SWG\Response(
     *     response="400",
     *     description="Invalid request, check your request"
     * )
     */
    public function listProduct(Request $request)
    {
        $input = $this->requestHandler->handle($request);
        $output = $this->loader->load($input);
        $hasProduct = count($output->getProducts()) > 0 ? true : false;

        return $this->sendResponse(
            $hasProduct ? $output->getProducts() : null,
            $hasProduct ? Response::HTTP_OK : Response::HTTP_NO_CONTENT
        );
    }
}
