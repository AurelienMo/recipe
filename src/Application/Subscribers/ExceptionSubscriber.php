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

namespace App\Application\Subscribers;

use App\Application\Exceptions\ValidatorException;
use App\UI\Responders\ErrorResponder;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class ExceptionSubscriber
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    /** @var ErrorResponder */
    private $errorResponder;

    /** @var LoggerInterface */
    private $logger;

    /**
     * ExceptionSubscriber constructor.
     *
     * @param ErrorResponder $errorResponder
     */
    public function __construct(
        ErrorResponder $errorResponder,
        LoggerInterface $logger
    ) {
        $this->errorResponder = $errorResponder;
        $this->logger = $logger;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::EXCEPTION => 'processException',
        ];
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    public function processException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        method_exists($exception, 'getMessage') ? $this->logger->critical($exception->getMessage()) : null;

        switch (get_class($exception)) {
            case ValidatorException::class:
                $this->processValidatorException($event);
                break;
            case HttpException::class:
                $this->processHttpException($event);
                break;
        }
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    private function processValidatorException(GetResponseForExceptionEvent $event)
    {
        $event->setResponse(
            $this->errorResponder->response(
                $event->getException()->getErrors(),
                $event->getException()->getStatusCode()
            )
        );
    }

    /**
     * @param GetResponseForExceptionEvent $event
     */
    private function processHttpException(GetResponseForExceptionEvent $event)
    {
        $event->setResponse(
            $this->errorResponder->response(
                ['message' => $event->getException()->getMessage()],
                $event->getException()->getStatusCode()
            )
        );
    }

}
