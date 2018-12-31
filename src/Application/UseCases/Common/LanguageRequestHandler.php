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

namespace App\Application\UseCases\Common;

use App\Application\UseCases\AbstractRequestHandler;
use App\Application\UseCases\InputInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class LanguageRequestHandler
 */
class LanguageRequestHandler extends AbstractRequestHandler
{
    public function handle(Request $request): InputInterface
    {
        $input = $this->instanciateInputClass();
        $input->setLang($request->query->get('lang') ?? null);

        $this->validate($input);

        return $input;
    }

    protected function getClassInput(): string
    {
        return LanguageInput::class;
    }

    protected function havePayload(): bool
    {
        return false;
    }
}
