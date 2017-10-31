<?php

namespace App\Middleware;

class MiddleWare
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }
}
