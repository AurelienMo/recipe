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

use App\Domain\Model\Traits\IdentifierTrait;
use App\Domain\Model\Traits\TimestampableTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractModel
 */
abstract class AbstractModel
{
    use IdentifierTrait;
    use TimestampableTrait;

    /**
     * @throws \Exception
     */
    public function onPersist()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\PreUpdate()
     *
     * @throws \Exception
     */
    public function onUpdate()
    {
        $this->updatedAt = new \DateTime();
    }
}
