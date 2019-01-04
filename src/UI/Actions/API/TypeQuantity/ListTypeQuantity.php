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

namespace App\UI\Actions\API\TypeQuantity;

use App\Application\UseCases\TypeQuantity\ListTypeQuantity\Loader;
use App\UI\Actions\API\AbstractApiResponder;
use App\UI\Responders\JsonResponder;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ListTypeQuantity
 */
class ListTypeQuantity extends AbstractApiResponder
{
    /** @var Loader */
    private $loader;

    public function __construct(
        JsonResponder $responder,
        Loader $loader
    ) {
        $this->loader = $loader;
        parent::__construct($responder);
    }

    /**
     * @Route("/types-quantity", name="list_type_quantity", methods={"GET"})
     *
     * @SWG\Response(
     *     response="200",
     *     description="Successful list product's type quantity",
     *     @SWG\Schema(
     *         ref="#/definitions/ListTypeQuantityOutput"
     *     )
     * )
     * @SWG\Response(
     *     response="403",
     *     description="Forbidden access."
     * )
     * @SWG\Tag(name="Type Quantity")
     * @Security(name="Bearer")
     *
     * @return Response
     */
    public function listTypeQuantity()
    {
        $output = $this->loader->load(null);

        return $this->sendResponse($output->getTypesProduct());
    }
}
