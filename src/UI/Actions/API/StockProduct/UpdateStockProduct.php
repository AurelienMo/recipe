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

use App\UI\Actions\API\AbstractApiResponder;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateStockProduct
 */
class UpdateStockProduct extends AbstractApiResponder
{
    /**
     * @Route("/groups/{groupId}/stock-product/{stockId}", name="update_stock_product", methods={"PUT"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @SWG\Parameter(
     *     in="path",
     *     name="groupId",
     *     type="integer",
     *     required=true,
     *     description="Group Id targeted to update stock product"
     * )
     * @SWG\Parameter(
     *     in="path",
     *     name="stockId",
     *     type="integer",
     *     required=true,
     *     description="Stock id targeted to update stock quantity"
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Datas stock product to update stock product",
     *     required=true,
     *     @SWG\Schema(ref="#/definitions/UpdateStockProductInput")
     * )
     * @SWG\Response(
     *     response="200",
     *     description="Successful update product to stock",
     *     @SWG\Schema(ref="#/definitions/StockItemOutput")
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
    public function update(Request $request)
    {
        return $this->sendResponse(null);
    }
}
