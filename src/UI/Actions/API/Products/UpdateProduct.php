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
use App\Application\UseCases\Products\Update\UpdateProductPersister;
use App\Application\UseCases\Products\Update\UpdateProductRequestHandler;
use App\UI\Actions\API\AbstractApiResponder;
use App\UI\Responders\JsonResponder;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UpdateProduct
 */
class UpdateProduct extends AbstractApiResponder
{
    /** @var UpdateProductRequestHandler */
    private $requestHandler;

    /** @var UpdateProductPersister */
    private $persister;

    public function __construct(
        JsonResponder $responder,
        UpdateProductRequestHandler $requestHandler,
        UpdateProductPersister $persister
    ) {
        $this->requestHandler = $requestHandler;
        $this->persister = $persister;
        parent::__construct($responder);
    }


    /**
     * Update fields for a given product
     *
     * @Route("/products/{id}", name="update_product", methods={"PUT"})
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
     *     name="id",
     *     type="integer",
     *     description="Unique identifier for a product",
     *     required=true
     * )
     * @SWG\Parameter(
     *     in="body",
     *     name="body",
     *     description="Datas product to add product into database",
     *     required=true,
     *     @SWG\Schema(ref=@Model(
     *         type=App\Application\UseCases\Products\Update\UpdateProductInput::class
     *     ))
     * )
     * @SWG\Response(
     *     response="200",
     *     description="Succcessful update product"
     * )
     * @SWG\Response(
     *     response="204",
     *     description="No content updated."
     * )
     * @SWG\Response(
     *     response="400",
     *     description="Bad request. Check your request."
     * )
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function update(Request $request)
    {
        $input = $this->requestHandler->handle($request);
        $output = $this->persister->save($input);

        return $this->sendResponse(
            $output ?? null,
            $output ? Response::HTTP_OK : Response::HTTP_NO_CONTENT
        );
    }
}
