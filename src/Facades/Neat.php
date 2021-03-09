<?php

namespace Wantp\Neat\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Admin
 * @package Wantp\Neat\Facades
 *
 * @method static string version()
 * @method static void runsMigrations()
 * @method static void shouldRunMigrations()
 * @method static void ignoreMigrations()
 * @method static string root()
 * @method static string routePath()
 * @method static string routePrefix()
 * @method static string controllersPath()
 * @method static string resourcesPath()
 * @method static string filtersPath()
 * @method static string modelsPath()
 *
 * @see \Wantp\Neat\Neat
 */
class Neat extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'neat-admin';
    }
}