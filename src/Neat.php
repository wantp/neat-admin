<?php


namespace Wantp\Neat;


class Neat
{
    /**
     * @var bool
     */
    protected $runsMigrations = true;

    /**
     * Admin constructor.
     */
    public function __construct()
    {
        $this->version = config('neat.version');
    }

    /**
     * @return mixed
     */
    public function version()
    {
        return $this->version;
    }

    /**
     * Run default migration status
     *
     * @return bool
     */
    public function runsMigrations()
    {
        return $this->runsMigrations;
    }

    /**
     * Run default migration
     */
    public function shouldRunMigrations()
    {
        $this->runsMigrations = true;
    }

    /**
     * Ignore default migration
     */
    public function ignoreMigrations()
    {
        $this->runsMigrations = false;
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function root()
    {
        return config('admin.root');
    }

    /**
     * @return string
     */
    public function routePath()
    {
        return $this->root() . '/routes.php';
    }

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function routePrefix()
    {
        return config('admin.route.prefix');
    }

    /**
     * @return string
     */
    public function controllersPath()
    {
        return $this->root() . '/Http/Controllers';
    }
}