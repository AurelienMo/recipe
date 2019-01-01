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

use App\UI\Actions\API\AbstractApiResponder;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AddProduct
 */
class AddProduct extends AbstractApiResponder
{
    /**
     * Add a product to database product
     *
     * @Route("/products", name="add_product_database", methods={"POST"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Datas product to add product into database",
     *     required=true,
     *     @SWG\Schema(ref=@Model(
     *         type=App\Application\UseCases\Products\Add\AddProductInput::class
     *     ))
     *
     * )
     * @SWG\Response(
     *     response="201",
     *     description="Successful creation product",
     *     @SWG\Schema(
     *         ref="#/definitions/AddProductOutput"
     *     )
     * )
     * @SWG\Response(
     *     response="400",
     *     description="Bad request. Please check your credentials"
     * )
     * @SWG\Tag(name="Product")
     */
    public function add(Request $request)
    {
    }
}
