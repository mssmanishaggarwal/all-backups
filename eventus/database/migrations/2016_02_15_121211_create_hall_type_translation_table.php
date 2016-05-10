<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHallTypeTranslationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	 Schema::create('hall_type', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('is_active', array(0, 1))->default(0);
            $table->integer('order_id');
            $table->timestamps();
        });
        
         Schema::create('hall_type_translation', function (Blueprint $table) {
            $table->increments('hall_type_translation_id');
            $table->integer('hall_type_id')->unsigned();            
            $table->integer('language_id');            
            $table->string('hall_type_name', 100);  
            $table->foreign('hall_type_id')->references('id')->on('hall_type')->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('hall_type_translation');
        Schema::drop('hall_type');
    }
}
