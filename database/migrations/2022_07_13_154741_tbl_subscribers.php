<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::create('tbl_subscribers', function(Blueprint $table){
                $table->increments('id');
                $table->string('email');
                $table->integer('website_id');
            });



        Schema::create('tbl_web1post', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('is_new')->default('1');
        });

        Schema::create('tbl_web2post', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('is_new')->default('1');
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
};
