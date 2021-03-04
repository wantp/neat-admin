<?php

use Wantp\Neat\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNeatRoleMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('admin.database.tables.role_menu'), function (Blueprint $table) {
            $table->integer('role_id');
            $table->integer('menu_id');

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->nullable();

            $table->unique(['role_id', 'menu_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists(config('admin.database.tables.role_menu'));
    }
}
