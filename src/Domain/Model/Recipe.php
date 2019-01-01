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

namespace App\Domain\Model;

use App\Domain\Model\Traits\NameTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Recipe
 *
 * @ORM\Table(name="amo_recipe")
 * @ORM\Entity()
 */
class Recipe extends AbstractModel
{
    use NameTrait;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $preparationTime;

    /**
     * @var TypeRecipe
     *
     * @ORM\ManyToOne(targetEntity="TypeRecipe")
     * @ORM\JoinColumn(name="type_recipe_id", referencedColumnName="id")
     */
    protected $typeRecipe;

    public function __construct(
        string $name,
        ?int $preparationTime,
        TypeRecipe $typeRecipe
    ) {
        $this->name = $name;
        $this->typeRecipe = $typeRecipe;
        $this->preparationTime = $preparationTime;
    }

    /**
     * @return int|null
     */
    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    /**
     * @return TypeRecipe
     */
    public function getTypeRecipe(): TypeRecipe
    {
        return $this->typeRecipe;
    }
}
