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

namespace App\Application\Listeners\Doctrine\Model;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Predis\Client;

/**
 * Class AbstractModelListener
 */
abstract class AbstractModelListener
{
    /** @var Client */
    protected $cacheDriver;

    /**
     * AbstractModelListener constructor.
     *
     * @param Client $cacheDriver
     */
    public function __construct(
        Client $cacheDriver
    ) {
        $this->cacheDriver = $cacheDriver;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $className = $this->getClassName();
        if ($args->getEntity() instanceof $className) {
            $this->processReinitTtl();
        }
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $className = $this->getClassName();
        if ($args->getEntity() instanceof $className) {
            $this->processReinitTtl();
        }
    }

    public function postRemove(LifecycleEventArgs $args)
    {
        $className = $this->getClassName();
        if ($args->getEntity() instanceof $className) {
            $this->processReinitTtl();
        }
    }

    public function processReinitTtl()
    {
        foreach ($this->getCacheKeys() as $cacheKey) {
            foreach ($this->getAllKeys() as $redisKey) {
                if (strstr($redisKey, $cacheKey)) {
                    $this->cacheDriver->expire($redisKey, 0);
                }
            }
        }
    }


    public function getAllKeys()
    {
        return $this->cacheDriver->keys('*');
    }

    /**
     * Return entity class name
     *
     * @return string
     */
    abstract protected function getClassName(): string;

    /**
     * Return list keys to clear cache Redis.
     *
     * @return array
     */
    abstract protected function getCacheKeys(): array;
}
