<?php

namespace App\Http;

use App\Http\Middleware\IsAdmin;

class Kernel extends HttpKernel
{
    protected $middlewareAliases = [
        'admin' => IsAdmin::class,
    ];
} 