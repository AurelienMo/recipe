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

namespace App\Application\UseCases\Products\ListWithFilter;

use App\Application\UseCases\AbstractInput;
use App\Application\UseCases\InputInterface;

/**
 * Class ListProductInput
 */
class ListProductInput extends AbstractInput implements InputInterface
{
    /**
     * List of type products required
     *
     * @var string[]|null
     */
    protected $typeProducts;

    /**
     * @return array|null
     */
    public function getTypeProducts(): ?array
    {
        return $this->typeProducts;
    }

    /**
     * @param array|null $typeProducts
     */
    public function setTypeProducts(?array $typeProducts): void
    {
        $this->typeProducts = $typeProducts;
    }
}
