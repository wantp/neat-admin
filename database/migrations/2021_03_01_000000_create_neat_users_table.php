<?php

use Wantp\Neat\Database\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNeatUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->schema->create(config('neat.database.tables.users'), function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('username', 50)->unique();
            $table->string('nickname', 100)->nullable();
            $table->string('password', 80);
            $table->string('avatar')->default('');
            $table->string('last_login_ip', 40)->default('');
            $table->timestamp('last_login_time')->nullable();

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
        $this->schema->dropIfExists(config('neat.database.tables.users'));
    }
}
