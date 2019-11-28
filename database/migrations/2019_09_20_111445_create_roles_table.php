<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->smallInteger('level')->unsigned();
            $table->string('code', 10)->unique();
            $table->string('name', 100)->unique();
            $table->bigInteger('avatar_id')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('roles', function (Blueprint $table) {
            $table->foreign('avatar_id')
                ->references('id')
                ->on('files');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
