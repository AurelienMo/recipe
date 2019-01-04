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

namespace App\Application\UseCases\TypeQuantity\ListTypeQuantity;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\AbstractLoader;
use App\Application\UseCases\TypesProduct\ListTypeProduct\Output\ListTypesProductOutput;
use App\Application\UseCases\TypesProduct\ListTypeProduct\Output\TypeProductItemOutput;
use App\Domain\Model\TypeQuantity;
use App\UI\Responders\OutputInterface;

/**
 * Class Loader
 */
class Loader extends AbstractLoader
{
    public function load(?AbstractInput $input): OutputInterface
    {
        $typesQuantity = $this->getRepository()->loadAllTypesQuantity();

        return $this->buildOutput($typesQuantity);
    }

    protected function getClassRepository(): string
    {
        return TypeQuantity::class;
    }

    private function buildOutput(array $typesQuantity)
    {
        $output = new ListTypesProductOutput();
        /** @var TypeQuantity $item */
        foreach ($typesQuantity as $item) {
            $output->addTypeProduct(
                new TypeProductItemOutput(
                    $item->getId(),
                    $this->translatorBuilder->buildTranslatable(
                        $item->getName(),
                        'messages'
                    )
                )
            );
        }

        return $output;
    }
}
