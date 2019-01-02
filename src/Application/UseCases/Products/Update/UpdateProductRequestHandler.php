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

namespace App\Application\UseCases\Products\Update;

use App\Application\UseCases\AbstractRequestHandler;
use App\Application\UseCases\InputInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class UpdateProductRequestHandler
 */
class UpdateProductRequestHandler extends AbstractRequestHandler
{
    public function handle(Request $request): InputInterface
    {
        $input = $this->hydrateInputWithPayload($request);
        $input->setProductId(
            (int) $request->attributes->get('id') ?? null
        );

        $this->validate($input);

        return $input;
    }

    protected function getClassInput(): string
    {
        return UpdateProductInput::class;
    }

    protected function havePayload(): bool
    {
        return true;
    }
}
