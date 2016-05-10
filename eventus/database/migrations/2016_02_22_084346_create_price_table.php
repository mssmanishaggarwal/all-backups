<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	Schema::create('currency', function (Blueprint $table) {
            $table->increments('id');
            $table->string('currency_name', 100);
            $table->string('currency_code', 20);
        });
        
        Schema::create('price_range', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currency_id');
             $table->float('lower_range');
            $table->float('upper_range');
            $table->enum('is_active', array(0, 1))->default(0);          
            $table->timestamps();
        });
        
         Schema::create('price_range_translation', function (Blueprint $table) {
            $table->increments('price_range_translation_id');
            $table->integer('price_range_id')->unsigned();            
            $table->integer('language_id');            
            $table->string('price_range_title', 100);
            $table->foreign('price_range_id')->references('id')->on('price_range')->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('price_range');
        Schema::drop('price_range_translation');
    }
}
