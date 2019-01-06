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
use App\Application\UseCases\StockProduct\ListStock\ListStockRequestHandler;
use App\Application\UseCases\StockProduct\ListStock\Loader;
use App\UI\Actions\API\AbstractApiResponder;
use App\UI\Responders\JsonResponder;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListStockProduct
 */
class ListStockProduct extends AbstractApiResponder
{
    /** @var ListStockRequestHandler */
    private $requestHandler;

    /** @var Loader */
    private $loader;

    public function __construct(
        JsonResponder $responder,
        ListStockRequestHandler $requestHandler,
        Loader $loader
    ) {
        $this->requestHandler = $requestHandler;
        $this->loader = $loader;
        parent::__construct($responder);
    }

    /**
     * List all stock related a given group
     *
     * @Route("/groups/{groupId}/stock-product", name="list_all_stock_product", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws ValidatorException
     *
     * @SWG\Parameter(
     *     in="query",
     *     name="typeProduct",
     *     type="integer",
     *     required=false,
     *     description="Filter list stock per product type"
     * )
     * @SWG\Response(
     *     response="200",
     *     description="Successful list stock for a given group",
     *     @SWG\Schema(ref="#/definitions/StockOutput")
     * )
     * @SWG\Response(
     *     response="204",
     *     description="Successful. No content datas."
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
    public function listStockProduct(Request $request)
    {
        $input = $this->requestHandler->handle($request);
        $output = $this->loader->load($input);
        $hasItem = count($output->getItems()) > 0;

        return $this->sendResponse(
            $hasItem ? $output->getItems() : null,
            $hasItem ? Response::HTTP_OK : Response::HTTP_NO_CONTENT
        );
    }
}
