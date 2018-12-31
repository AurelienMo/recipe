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

namespace App\UI\Responders;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class JsonResponder
 */
class JsonResponder
{
    /** @var SerializerInterface */
    private $serializer;

    /**
     * JsonResponder constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(
        SerializerInterface $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * @param mixed|null $output
     * @param int                  $statusCode
     *
     * @return Response
     */
    public function response($output = null, int $statusCode = Response::HTTP_OK)
    {
        return new Response(
            $output ? $this->serializer->serialize($output, 'json') : null,
            $statusCode,
            [
                'Content-Type' => 'application/json',
            ]
        );
    }
}
