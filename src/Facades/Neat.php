<?php

namespace Wantp\Neat\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Admin
 * @package Wantp\Neat\Facades
 *
 * @method static \Wantp\Neat\Neat configs()
 * @method static \Wantp\Neat\Neat version()
 * @method static \Wantp\Neat\Neat runsMigrations()
 * @method static \Wantp\Neat\Neat shouldRunMigrations()
 * @method static \Wantp\Neat\Neat ignoreMigrations()
 * @method static \Wantp\Neat\Neat root()
 * @method static \Wantp\Neat\Neat routePath()
 * @method static \Wantp\Neat\Neat routePrefix()
 * @method static \Wantp\Neat\Neat routes()
 * @method static \Wantp\Neat\Neat controllersPath()
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