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

namespace App\UI\Actions\API;

use App\UI\Responders\JsonResponder;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AbstractApiResponder
 */
class AbstractApiResponder
{
    /** @var JsonResponder */
    protected $responder;

    /**
     * AbstractApiAction constructor.
     *
     * @param JsonResponder $responder
     */
    public function __construct(
        JsonResponder $responder
    ) {
        $this->responder = $responder;
    }

    /**
     * @param null $datas
     * @param int  $statusCode
     *
     * @return Response
     */
    public function sendResponse($datas = null, int $statusCode = Response::HTTP_OK)
    {
        return $this->responder->response($datas, $statusCode);
    }
}
