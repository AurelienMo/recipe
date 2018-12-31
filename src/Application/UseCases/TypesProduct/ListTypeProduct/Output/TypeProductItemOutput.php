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

namespace App\Application\UseCases\TypesProduct\ListTypeProduct\Output;

/**
 * Class TypeProductItemOutput
 */
class TypeProductItemOutput
{
    /**
     * Unique identifier product's type
     *
     * @var int
     */
    protected $id;

    /**
     * Translatable's names string
     *
     * @var string[]
     */
    protected $names;

    /**
     * TypeProductItemOutput constructor.
     *
     * @param int      $id
     * @param string[] $names
     */
    public function __construct(
        int $id,
        array $names
    ) {
        $this->id = $id;
        $this->names = $names;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string[]
     */
    public function getNames(): array
    {
        return $this->names;
    }
}
