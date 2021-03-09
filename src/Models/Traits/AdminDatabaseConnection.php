<?php

namespace Wantp\Neat\Models\Traits;

trait AdminDatabaseConnection
{
    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getConnectionName()
    {
        return config('neat.database.connection') ?: config('database.default');
    }

    /**
     * @param $key
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function getTableName($key)
    {
        return config('neat.database.tables.' . $key);
    }
}