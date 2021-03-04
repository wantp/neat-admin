<?php

use Wantp\Neat\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNeatPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('admin.database.tables.permissions'), function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->string('method')->default('');
            $table->string('http_path')->default('');
            $table->integer('order')->default(1);

            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate()->nullable();
            $table->softDeletes();

            $table->unique(['name','deleted_at']);
            $table->unique(['slug','deleted_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $this->schema->dropIfExists(config('admin.database.tables.permissions'));
    }
}
