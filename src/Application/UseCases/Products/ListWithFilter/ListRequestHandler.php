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

namespace App\Application\UseCases\Products\ListWithFilter;

use App\Application\UseCases\AbstractRequestHandler;
use App\Application\UseCases\InputInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ListRequestHandler
 */
class ListRequestHandler extends AbstractRequestHandler
{
    public function handle(Request $request): InputInterface
    {
        $input = $this->instanciateInputClass();
        $input->setLang($request->query->get('lang') ?? 'fr');
        if ($request->query->has('typesProduct')) {
            $input->setTypeProducts(
                explode(',', $request->query->get('typesProduct'))
            );
        }

        $this->validate($input);

        return $input;
    }

    /**
     * @return string
     */
    protected function getClassInput(): string
    {
        return ListProductInput::class;
    }

    protected function havePayload(): bool
    {
        return false;
    }
}
