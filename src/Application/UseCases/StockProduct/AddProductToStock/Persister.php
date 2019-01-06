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

namespace App\Application\UseCases\StockProduct\AddProductToStock;

use App\Application\UseCases\AbstractPersister;
use App\Application\UseCases\InputInterface;
use App\Application\UseCases\StockProduct\ListStock\ListStockInput;
use App\Application\UseCases\StockProduct\ListStock\Loader;
use App\Application\UseCases\StockProduct\Output\StockOutput;
use App\Domain\Builders\ProductBuilder;
use App\Domain\Builders\StockProductBuilder;
use App\Domain\Model\Product;
use App\Domain\Model\StockProduct;
use App\Domain\Model\TypeProduct;
use App\Domain\Model\TypeQuantity;
use App\UI\Responders\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

/**
 * Class Persister
 */
class Persister extends AbstractPersister
{
    /** @var Loader */
    private $loader;

    /**
     * Persister constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param Loader                 $loader
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        Loader $loader
    ) {
        $this->loader = $loader;
        parent::__construct($entityManager);
    }

    /**
     * @param InputInterface|AddStockProductInput $input
     *
     * @return OutputInterface|StockOutput|null
     *
     * @throws NonUniqueResultException
     */
    public function save(InputInterface $input): ?OutputInterface
    {
        $stockProduct = StockProductBuilder::create(
            $input->getGroup(),
            $this->getProduct($input),
            $input->getQuantity()
        );

        $this->entityManager->persist($stockProduct);
        $this->entityManager->flush();

        $listStockInput = new ListStockInput();
        $listStockInput->setGroup($input->getGroup());

        return $this->loader->load(
            $listStockInput
        );
    }

    protected function getClassRepository(): string
    {
        return StockProduct::class;
    }

    /**
     * @param AddStockProductInput $input
     *
     * @return Product
     *
     * @throws NonUniqueResultException
     */
    private function getProduct(AddStockProductInput $input)
    {
        $product = null;
        if (!is_null($input->getProductId())) {
            $product = $this->entityManager->getRepository(Product::class)
                ->loadById((int) $input->getProductId());
        }
        if (is_null($input->getProductId()) && !is_null($input->getProduct())) {
            $product = ProductBuilder::build(
                $input->getProduct()->getName(),
                $this->entityManager->getRepository(TypeProduct::class)
                    ->findByFilters(
                        [
                            'id' => $input->getProduct()->getTypeProduct(),
                        ]
                    )[0],
                $this->entityManager->getRepository(TypeQuantity::class)
                    ->findByFilters(
                        [
                            'id' => $input->getProduct()->getTypeQuantity(),
                        ]
                    )[0]
            );
            $this->entityManager->persist($product);
            $this->entityManager->flush();
        }

        return $product;
    }
}
