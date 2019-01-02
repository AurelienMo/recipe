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

use Doctrine\ORM\Mapping as ORM;

/**
 * Class StepRecipe
 */
class StepRecipe extends AbstractModel
{
    /** @var int */
    protected $number;

    /** @var string */
    protected $description;

    /** @var Recipe */
    protected $recipe;

    /**
     * StepRecipe constructor.
     *
     * @param int    $number
     * @param string $description
     * @param Recipe $recipe
     */
    public function __construct(
        int $number,
        string $description,
        Recipe $recipe
    ) {
        $this->number = $number;
        $this->description = $description;
        $this->recipe = $recipe;
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Recipe
     */
    public function getRecipe(): Recipe
    {
        return $this->recipe;
    }
}
