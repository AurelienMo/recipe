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

namespace App\Domain\Model\Traits;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trait QuantityTrait
 */
trait QuantityTrait
{
    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $quantity;

    /**
     * @return float
     */
    public function getQuantity(): float
    {
        return $this->quantity;
    }
}
