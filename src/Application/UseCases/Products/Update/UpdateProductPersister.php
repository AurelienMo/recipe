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

use App\Application\UseCases\AbstractPersister;
use App\Application\UseCases\InputInterface;
use App\Application\UseCases\Products\Add\Output\AddProductOutput;
use App\Domain\Model\Product;
use App\UI\Responders\OutputInterface;

/**
 * Class UpdateProductPersister
 */
class UpdateProductPersister extends AbstractPersister
{
    /**
     * @param InputInterface|UpdateProductInput $input
     *
     * @return OutputInterface|null
     */
    public function save(InputInterface $input): ?OutputInterface
    {
        $result = $input->getProduct()->updateDatas($input);

        if ($result) {
            $this->entityManager->flush();

            return $this->buildOutput($input->getProduct(), $input);
        }

        return null;
    }

    protected function getClassRepository(): string
    {
        return Product::class;
    }

    /**
     * @param Product            $product
     * @param UpdateProductInput $input
     *
     * @return AddProductOutput
     */
    private function buildOutput(Product $product, UpdateProductInput $input)
    {
        return new AddProductOutput(
            $product->getId(),
            $product->getName(),
            $product->getSlug(),
            $input->getTypeProduct() ?? $product->getTypeProduct()->getId(),
            $input->getTypeQuantity() ?? $product->getTypeQuantity()->getId()
        );
    }
}
