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
 * Class TypeRecipe
 */
class TypeRecipe extends AbstractModel
{
    use NameTrait;

    /**
     * TypeRecipe constructor.
     *
     * @param string $name
     */
    public function __construct(
        string $name
    ) {
        $this->name = $name;
    }
}
