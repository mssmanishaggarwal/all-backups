<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccommodationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accommodation', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('is_active', array(0, 1))->default(0);
            $table->integer('order_id');
            $table->timestamps();
        });
        
         Schema::create('accommodation_translation', function (Blueprint $table) {
            $table->increments('accommodation_translation_id');
            $table->integer('accommodation_id')->unsigned();            
            $table->integer('language_id');            
            $table->string('accommodation_name', 100);  
            $table->foreign('accommodation_id')->references('id')->on('accommodation')->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('accommodation');
        Schema::drop('accommodation_translation');
    }
}
