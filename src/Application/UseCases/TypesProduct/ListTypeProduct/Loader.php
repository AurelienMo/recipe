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

namespace App\Application\UseCases\TypesProduct\ListTypeProduct;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\AbstractLoader;
use App\Application\UseCases\TypesProduct\ListTypeProduct\Output\ListTypesProductOutput;
use App\Application\UseCases\TypesProduct\ListTypeProduct\Output\TypeProductItemOutput;
use App\Domain\Model\TypeProduct;
use App\UI\Responders\OutputInterface;

/**
 * Class Loader
 */
class Loader extends AbstractLoader
{
    public function load(?AbstractInput $input): OutputInterface
    {
        $typesProduct = $this->getRepository()->loadAllTypesProduct();

        return $this->buildOutput($typesProduct);
    }

    protected function getClassRepository(): string
    {
        return TypeProduct::class;
    }

    private function buildOutput(array $typesProduct)
    {
        $output = new ListTypesProductOutput();
        /** @var TypeProduct $item */
        foreach ($typesProduct as $item) {
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
