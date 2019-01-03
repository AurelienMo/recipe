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

use App\Domain\Model\AbstractModel;
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

    public function postPersist(AbstractModel $model, LifecycleEventArgs $args)
    {
        foreach ($this->getCacheKeys() as $key) {
            $this->cacheDriver->expire(sprintf('[%s][1]', $key), 0);
        }
    }

    public function postUpdate(AbstractModel $model, LifecycleEventArgs $args)
    {
        foreach ($this->getCacheKeys() as $key) {
            $this->cacheDriver->expire(sprintf('[%s][1]', $key), 0);
        }
    }

    public function postRemove(AbstractModel $model, LifecycleEventArgs $args)
    {
        foreach ($this->getCacheKeys() as $key) {
            $this->cacheDriver->expire(sprintf('[%s][1]', $key), 0);
        }
    }

    /**
     * Return list keys to clear cache Redis.
     *
     * @return array
     */
    abstract public function getCacheKeys(): array;
}
