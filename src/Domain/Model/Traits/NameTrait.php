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

/**
 * Trait NameTrait
 */
trait NameTrait
{
    /** @var string */
    protected $name;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
