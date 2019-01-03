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

namespace App\UI\Actions\API\TypeProduct;

use App\Application\Exceptions\ValidatorException;
use App\Application\UseCases\Common\LanguageRequestHandler;
use App\Application\UseCases\TypesProduct\ListTypeProduct\Loader;
use App\UI\Actions\API\AbstractApiResponder;
use App\UI\Responders\JsonResponder;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListTypeProduct
 */
class ListTypeProduct extends AbstractApiResponder
{
    /** @var LanguageRequestHandler */
    private $requestHandler;

    /** @var Loader */
    private $loader;

    /**
     * ListTypeProduct constructor.
     *
     * @param JsonResponder          $responder
     * @param LanguageRequestHandler $requestHandler
     * @param Loader                 $loader
     */
    public function __construct(
        JsonResponder $responder,
        LanguageRequestHandler $requestHandler,
        Loader $loader
    ) {
        $this->requestHandler = $requestHandler;
        $this->loader = $loader;
        parent::__construct($responder);
    }

    /**
     * List product's type
     *
     * @Route("/types-product", name="list_product_types", methods={"GET"})
     *
     * @param Request $request
     *
     * @return Response
     *
     * @throws ValidatorException
     * @throws \ReflectionException
     *
     * @SWG\Response(
     *     response="200",
     *     description="Successful list product's type",
     *     @SWG\Schema(
     *         ref="#/definitions/ListProductTypeOutput"
     *     )
     * )
     * @SWG\Response(
     *     response="400",
     *     description="Bad request. Check your request"
     * )
     * @SWG\Tag(name="Product Type")
     * @Security(name="Bearer")
     */
    public function listTypeProduct(Request $request)
    {
        $input = $this->requestHandler->handle($request);
        $output = $this->loader->load($input);

        return $this->sendResponse($output->getTypesProduct());
    }
}
