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

namespace App\Application\UseCases\GroupUser\Create;

use App\Application\Helpers\Core\Slugger;
use App\Application\UseCases\AbstractRequestHandler;
use App\Application\UseCases\InputInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class CreateGroupRequestHandler
 */
class CreateGroupRequestHandler extends AbstractRequestHandler
{
    public function handle(Request $request): InputInterface
    {
        /** @var AddGroupInput $input */
        $input = $this->hydrateInputWithPayload($request);
        $input->setOwner($this->tokenStorage->getToken()->getUser());
        $input->setSlug(
            $input->getName() ? Slugger::slugify($input->getName()) : null
        );

        $this->validate($input);

        return $input;
    }

    protected function getClassInput(): string
    {
        return AddGroupInput::class;
    }

    protected function havePayload(): bool
    {
        return true;
    }
}
