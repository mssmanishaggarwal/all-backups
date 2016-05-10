<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertisementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('position', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position_name');
            $table->string('size');
        });
        
        Schema::create('advertisement', function (Blueprint $table) {
            $table->increments('id');
            $table->string('advertisement_link');                      
            $table->integer('position_id');          
            $table->enum('is_active', array(0, 1))->default(0);          
            $table->date('start_date');
            $table->date('end_date');
        });
        
         Schema::create('advertisement_translation', function (Blueprint $table) {
            $table->increments('advertisement_translation_id');
            $table->integer('advertisement_id')->unsigned();            
            $table->integer('language_id');            
            $table->string('advertisement_title', 100);
            $table->foreign('advertisement_id')->references('id')->on('advertisement')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('advertisement');
        Schema::drop('advertisement_translation');
    }
}
