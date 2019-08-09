<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin',function($table){
            $table->string('github')->nullable();
            $table->string('facebook')->nullable();
            $table->string('skype')->nullable();
            $table->string('avatar')->nullable();
            $table->string('email',100)->unique();
            $table->integer('age')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
