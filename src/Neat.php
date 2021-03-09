<?php


namespace Wantp\Neat;


class Neat
{
    /**
     * @var string
     */
    protected $version;

    /**
     * @var bool
     */
    protected $runsMigrations = true;

    /**
     * Neat constructor.
     */
    public function __construct()
    {
        $this->version = config('neat_default.version');
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
     * @return string
     */
    public function root()
    {
        return config('neat.root');
    }

    /**
     * @return string
     */
    public function routePath()
    {
        return $this->root() . '/routes.php';
    }

    /**
     * @return string
     */
    public function routePrefix()
    {
        return config('neat.route.prefix');
    }

    /**
     * @return string
     */
    public function modelsPath()
    {
        return config('neat.models.path');
    }

    /**
     * @return string
     */
    public function controllersPath()
    {
        return $this->root() . '/Http/Controllers';
    }

    /**
     * @return string
     */
    public function resourcesPath()
    {
        return $this->root() . '/Http/Resources';
    }

    /**
     * @return string
     */
    public function filtersPath()
    {
        return $this->root() . '/Http/Filters';
    }
}