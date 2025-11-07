<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    protected $proxies = '*'; // confiar en todos los proxies
    protected $headers = \Illuminate\Http\Request::HEADER_X_FORWARDED_ALL;
    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
   
}
