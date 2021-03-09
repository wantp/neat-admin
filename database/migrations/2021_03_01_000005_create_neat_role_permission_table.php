<?php

use Wantp\Neat\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNeatRolePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('neat.database.tables.role_permission'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('permission_id');

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->nullable();

            $table->unique(['role_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists(config('neat.database.tables.role_permission'));
    }
}
