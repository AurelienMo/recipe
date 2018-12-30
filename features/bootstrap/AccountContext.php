<?php

declare(strict_types=1);

/*
 * This file is part of homemanagement-be
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Behat\Behat\Context\Context;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * Class AccountContext
 */
class AccountContext implements Context
{
    private $doctrine;

    /**
     * AccountContext constructor.
     *
     * @param RegistryInterface $doctrine
     */
    public function __construct(
        RegistryInterface $doctrine
    ) {
        $this->doctrine = $doctrine;
    }
}
