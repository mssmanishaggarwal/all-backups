<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('location', function (Blueprint $table) {
            $table->increments('location_id');
            $table->enum('is_active', array(0, 1))->default(0);
            $table->timestamps();
        });
        
         Schema::create('location_translation', function (Blueprint $table) {
            $table->increments('location_translation_id');
            $table->integer('location_id')->unsigned();            
            $table->integer('language_id');            
            $table->string('location_name', 100);  
            $table->foreign('location_id')->references('location_id')->on('location')->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('location');
        Schema::drop('location_translation');
    }
}
