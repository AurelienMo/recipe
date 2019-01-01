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

use App\Application\UseCases\InputInterface;
use App\Application\Validators\TypeProductExist;
use App\Application\Validators\TypeQuantityExist;
use App\Application\Validators\UniqueEntityInput;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AddProductInput
 *
 * @UniqueEntityInput(
 *     class="App\Domain\Model\Product",
 *     fields={"name"},
 *     message="Ce produit existe déjà en base de donnée."
 * )
 */
class AddProductInput implements InputInterface
{
    /**
     * Product's name to add
     *
     * @var string|null
     *
     * @Assert\NotBlank(
     *     message="Vous devez spécifier un nom de produit."
     * )
     */
    protected $name;

    /**
     * Unique identifier of product type
     *
     * @var int|null
     *
     * @Assert\NotBlank(
     *     message="Vous devez associer le produit à une catégorie de produit."
     * )
     * @TypeProductExist()
     */
    protected $typeProduct;

    /**
     * Unique identifier of type quantity
     *
     * @var int|null
     *
     * @Assert\NotBlank(
     *     message="Vous devez choisir un type de conditionnement pour l'ajout d'un produit."
     * )
     * @TypeQuantityExist()
     */
    protected $typeQuantity;

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getTypeProduct(): ?int
    {
        return $this->typeProduct;
    }

    /**
     * @param int|null $typeProduct
     */
    public function setTypeProduct(?int $typeProduct): void
    {
        $this->typeProduct = $typeProduct;
    }

    /**
     * @return int|null
     */
    public function getTypeQuantity(): ?int
    {
        return $this->typeQuantity;
    }

    /**
     * @param int|null $typeQuantity
     */
    public function setTypeQuantity(?int $typeQuantity): void
    {
        $this->typeQuantity = $typeQuantity;
    }
}
