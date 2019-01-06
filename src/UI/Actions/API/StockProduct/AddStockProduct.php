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

namespace App\UI\Actions\API\StockProduct;

use App\Application\Exceptions\ValidatorException;
use App\Application\UseCases\StockProduct\AddProductToStock\AddStockProductRequestHandler;
use App\UI\Actions\API\AbstractApiResponder;
use App\UI\Responders\JsonResponder;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddStockProduct
 */
class AddStockProduct extends AbstractApiResponder
{
    /** @var AddStockProductRequestHandler */
    private $requestHandler;

    public function __construct(
        JsonResponder $responder,
        AddStockProductRequestHandler $requestHandler
    ) {
        $this->requestHandler = $requestHandler;
        parent::__construct($responder);
    }

    /**
     * Add a product to stock of given group
     *
     * @Route("/groups/{groupId}/stock-product", name="add_stock_product", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws ValidatorException
     *
     * @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Datas stock product to add stock product to group",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/AddStockProductInput")
     * )
     * @SWG\Response(
     *     response="201",
     *     description="Succesfull add product to stock.",
     *     @SWG\Schema(ref="#/definitions/StockOutput")
     * )
     * @SWG\Response(
     *     response="400",
     *     description="Bad request. Please check your request."
     * )
     * @SWG\Response(
     *     response="401",
     *     description="Unauthorized. Please authenticate."
     * )
     * @SWG\Response(
     *     response="403",
     *     description="Forbidden access. You are not allowed to access to this ressource."
     * )
     * @SWG\Tag(name="Stock")
     * @Security(name="Bearer")
     */
    public function add(Request $request)
    {
        $input = $this->requestHandler->handle($request);

        return $this->sendResponse(null, Response::HTTP_CREATED);
    }
}