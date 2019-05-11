<?php

namespace App\Repositories\Modules\ZdTask;

use luffyzhao\laravelTools\Repositories\Facades\CacheAbstractDecorator;
use luffyzhao\laravelTools\Repositories\Cache\CacheInterface;

class Cache extends CacheAbstractDecorator implements Interfaces
{
    public function __construct(Interfaces $repo, CacheInterface $cache)
    {
        $this->repo = $repo;
        $this->cache = $cache;
    }
}
