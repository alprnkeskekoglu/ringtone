<?php

namespace Dawnstar;

use Illuminate\Contracts\Http\Kernel as HttpKernel;
use Dawnstar\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class DawnstarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $files = $this->app['files']->files(__DIR__ . '/Config');
        foreach ($files as $file) {
            $filename = $this->getConfigBasename($file);
            $this->mergeConfig($file, $filename);
        }


        $this->app->register(RouteServiceProvider::class);
        $this->app->singleton(HttpKernel::class, Kernel::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        if (file_exists(app_path('Http' . DIRECTORY_SEPARATOR . 'helpers.php'))) {
            include_once app_path('Http' . DIRECTORY_SEPARATOR . 'helpers.php');
        }
        if (file_exists(__DIR__ . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'helpers.php')) {
            include_once __DIR__ . DIRECTORY_SEPARATOR . 'Http' . DIRECTORY_SEPARATOR . 'helpers.php';
        }

        $this->loadMigrationsFrom(__DIR__ . '/Database/migrations');

        $this->publishes([__DIR__ . DIRECTORY_SEPARATOR . 'Assets' => public_path('vendor/dawnstar')], 'dawnstar');
        $this->loadViewsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'Resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR, 'Dawnstar');
    }

    private function getConfigBasename($file)
    {
        $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', basename($file));

        $filename = $name;

        return $filename;
    }

    protected function mergeConfig($path, $key)
    {
        $config = $this->app['config']->get($key, []);

        foreach (require $path as $k => $v) {
            if (is_array($v)) {
                if (isset($config[$k])) {
                    $config[$k] = array_merge($config[$k], $v);
                } else {
                    $config[$k] = $v;
                }

            } else {
                $config[$k] = $v;
            }
        }
        $this->app['config']->set($key, $config);
    }
}
