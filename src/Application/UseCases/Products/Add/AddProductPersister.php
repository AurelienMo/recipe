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

namespace App\Application\UseCases\Products\Add;

use App\Application\UseCases\AbstractPersister;
use App\Application\UseCases\InputInterface;
use App\Application\UseCases\Products\Add\Output\AddProductOutput;
use App\Domain\Builders\ProductBuilder;
use App\Domain\Model\Product;
use App\Domain\Model\TypeProduct;
use App\Domain\Model\TypeQuantity;
use App\UI\Responders\OutputInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class AddProductPersister
 */
class AddProductPersister extends AbstractPersister
{
    /**
     * @param InputInterface|AddProductInput $input
     *
     * @return OutputInterface|null
     */
    public function save(InputInterface $input): ?OutputInterface
    {
        $typeProduct = $this->getRepository(TypeProduct::class)
                            ->findByFilters(['id' => $input->getTypeProduct()]);
        $typeQuantity = $this->getRepository(TypeQuantity::class)
                             ->findByFilters(['id' => $input->getTypeQuantity()]);

        $product = ProductBuilder::build($input->getName(), $typeProduct[0], $typeQuantity[0]);

        try {
            $this->entityManager->persist($product);
            $this->entityManager->flush();
        } catch (\Exception $e) {
            throw new HttpException(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }

        return $this->buildOutput($product, $input);
    }

    /**
     * @return string
     */
    protected function getClassRepository(): string
    {
        return Product::class;
    }

    /**
     * @param Product         $product
     * @param AddProductInput $input
     *
     * @return AddProductOutput
     */
    private function buildOutput(Product $product, AddProductInput $input)
    {
        return new AddProductOutput(
            $product->getId(),
            $product->getName(),
            $product->getSlug(),
            $input->getTypeProduct(),
            $input->getTypeQuantity()
        );
    }
}
