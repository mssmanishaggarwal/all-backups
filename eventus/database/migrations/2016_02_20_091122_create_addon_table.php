<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addon', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('is_active', array(0, 1))->default(0);
            $table->integer('order_id');
            $table->timestamps();
        });
        
         Schema::create('addon_translation', function (Blueprint $table) {
            $table->increments('addon_translation_id');
            $table->integer('addon_id')->unsigned();            
            $table->integer('language_id');            
            $table->string('addon_name', 100);  
            $table->foreign('addon_id')->references('id')->on('addon')->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('addon');
        Schema::drop('addon_translation');
    }
}
