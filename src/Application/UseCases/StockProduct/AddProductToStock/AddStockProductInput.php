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

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\InputInterface;
use App\Application\UseCases\Products\Add\AddProductInput;
use App\Application\Validators\ProductAlreadyExistInStockProduct;
use App\Application\Validators\ProductIdOrNewProductShouldGiven;
use App\Domain\Model\GroupUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AddStockProductInput
 *
 * @ProductIdOrNewProductShouldGiven(
 *     message="Vous devez spécifier un identifiant de produit ou créer un nouveau produit."
 * )
 */
class AddStockProductInput extends AbstractInput implements InputInterface
{
    /**
     * @var GroupUser
     *
     * @Assert\NotBlank(
     *     message="Le groupe d'utilisateurs concerné ne peut être vide."
     * )
     */
    protected $group;

    /**
     * Unique identifier of an exist product into database
     *
     * @var int|null
     *
     * @ProductAlreadyExistInStockProduct(
     *     message="Le produit est déjà présent dans les stocks, nous vous invitons à mettre à jour le stock du produit concerné."
     * )
     */
    protected $productId;

    /**
     * @var AddProductInput|null
     *
     * @Assert\Valid()
     */
    protected $product;

    /**
     * Define quantity to add to stock
     *
     * @var float
     *
     * @Assert\NotBlank(
     *     message="La quantité a ajouté est requise."
     * )
     */
    protected $quantity;

    /**
     * @return GroupUser
     */
    public function getGroup(): GroupUser
    {
        return $this->group;
    }

    /**
     * @param GroupUser $group
     */
    public function setGroup(GroupUser $group): void
    {
        $this->group = $group;
    }

    /**
     * @return int|null
     */
    public function getProductId(): ?int
    {
        return $this->productId;
    }

    /**
     * @param int|null $productId
     */
    public function setProductId(?int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return AddProductInput|null
     */
    public function getProduct(): ?AddProductInput
    {
        return $this->product;
    }

    /**
     * @param AddProductInput|null $product
     */
    public function setProduct(?AddProductInput $product): void
    {
        $this->product = $product;
    }

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }

    /**
     * @param float $quantity
     */
    public function setQuantity(float $quantity): void
    {
        $this->quantity = $quantity;
    }
}
