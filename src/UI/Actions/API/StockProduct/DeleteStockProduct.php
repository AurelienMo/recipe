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
 * Class DeleteStockProduct
 */
class DeleteStockProduct extends AbstractApiResponder
{
    /**
     * Delete completely a product from group's stock
     *
     * @Route("/groups/{groupId}/stock-product/{stockId}", name="delete_product_from_stock", methods={"DELETE"})
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
     * @SWG\Response(
     *     response="204",
     *     description="Successful delete product from stock"
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
    public function delete(Request $request)
    {
        $input = $this->requestHandler->handle($request);
        $this->persister->save($input);

        return $this->sendResponse(null, Response::HTTP_NO_CONTENT);
    }
}
