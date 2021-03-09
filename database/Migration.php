<?php

namespace Wantp\Neat\Database;

use Illuminate\Database\Migrations\Migration as Base;
use Illuminate\Support\Facades\Schema;

class Migration extends Base
{
    /**
     * @var \Illuminate\Database\Schema\Builder
     */
    protected $schema;

    /**
     * Create a new migration instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->schema = Schema::connection($this->getConnection());
    }

    /**
     * Get the migration connection name.
     *
     * @return string|null
     */
    public function getConnection()
    {
        return config('neat.database.connection') ?: config('database.default');
    }
}