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

namespace App\Application\UseCases;

use App\Application\Exceptions\ValidatorException;
use App\Application\Helpers\Core\ErrorsBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\TokenStorage\TokenStorageInterface;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AbstractRequestHandler
 */
abstract class AbstractRequestHandler
{
    /** @var SerializerInterface */
    protected $serializer;

    /** @var ValidatorInterface */
    protected $validator;

    /** @var TokenStorageInterface */
    protected $tokenStorage;

    /**
     * AbstractRequestHandler constructor.
     *
     * @param SerializerInterface   $serializer
     * @param ValidatorInterface    $validator
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        SerializerInterface $serializer,
        ValidatorInterface $validator,
        TokenStorageInterface $tokenStorage
    ) {
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Handle request to give an input object
     *
     * @param Request $request
     *
     * @return InputInterface
     *
     * @throws \ReflectionException
     * @throws ValidatorException
     */
    public function handle(Request $request): InputInterface
    {
        $input = null;
        if ($this->havePayload()) {
            $input = $this->hydrateInputWithPayload($request);
        }
        if (!$input) {
            $input = $this->instanciateInputClass();
        }
        if (method_exists($input, 'setLang')) {
            $input->setLang($request->query->get('lang') ?? 'fr');
        }

        $this->validate($input);

        return $input;
    }

    /**
     * @param Request $request
     *
     * @return InputInterface|object
     */
    protected function hydrateInputWithPayload(Request $request)
    {
        return $this->serializer->deserialize($request->getContent(), $this->getClassInput(), 'json');
    }

    /**
     * Validate input according different constraints
     *
     * @param InputInterface $input
     *
     * @throws ValidatorException
     */
    protected function validate(InputInterface $input)
    {
        $constraintList = $this->validator->validate($input);
        if (count($constraintList) > 0) {
            ErrorsBuilder::buildErrors($constraintList);
        }
    }

    /**
     * @return string
     */
    abstract protected function getClassInput(): string;

    /**
     * @return bool
     */
    abstract protected function havePayload(): bool;

    protected function instanciateInputClass()
    {
        $reflectClass = new \ReflectionClass($this->getClassInput());
        $class = $reflectClass->name;

        return new $class();
    }
}
