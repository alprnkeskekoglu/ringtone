<?php

namespace Dawnstar\Http;

use Dawnstar\Http\Middleware\AdminMiddleware;
use Dawnstar\Http\Middleware\RedirecIfAuthenticated;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [];


    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'panel' => AdminMiddleware::class,
        'panel_guest' => RedirecIfAuthenticated::class,
    ];

}
