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
 * Class TypeQuantity
 *
 * @ORM\Table(name="amo_type_quantity")
 * @ORM\Entity(repositoryClass="App\Domain\Repository\TypeQuantityRepository")
 */
class TypeQuantity extends AbstractModel
{
    use NameTrait;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    protected $shortName;

    /**
     * TypeQuantity constructor.
     *
     * @param string $name
     * @param string $shortName
     */
    public function __construct(
        string $name,
        string $shortName
    ) {
        $this->name = $name;
        $this->shortName = $shortName;
    }

    /**
     * @return string
     */
    public function getShortName(): string
    {
        return $this->shortName;
    }
}
