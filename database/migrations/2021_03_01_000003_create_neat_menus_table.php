<?php

use Wantp\Neat\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNeatMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('admin.database.tables.menus'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('name', 50);
            $table->string('path')->default('');
            $table->string('icon')->nullable()->default('');
            $table->integer('order')->default(1);

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists(config('admin.database.tables.menus'));
    }
}
