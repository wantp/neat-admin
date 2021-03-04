<?php

namespace Wantp\Neat\Models\Traits;

trait AdminDatabaseConnection
{
    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    public function getConnectionName()
    {
        return config('admin.database.connection') ?: config('database.default');
    }

    /**
     * @param $key
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed
     */
    protected function getTableName($key)
    {
        return config('admin.database.tables.' . $key);
    }
}