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

namespace App\Application\Listeners\JWT;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTNotFoundEvent;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class JWTNotFound
 */
class JWTNotFound
{
    /**
     * @param JWTNotFoundEvent $event
     */
    public function onJWTNotFound(JWTNotFoundEvent $event)
    {
        $data = [
            'status' => Response::HTTP_FORBIDDEN,
            'message' => 'Vous n\'êtes pas autorisé à accéder à cette information.'
        ];

        $response = new JsonResponse($data, Response::HTTP_FORBIDDEN);

        $event->setResponse($response);
    }
}
