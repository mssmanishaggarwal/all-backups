<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subscription extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('subscription', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscription_month');
            $table->float('subscription_price');            
            $table->enum('is_active', array(0, 1))->default(0);          
            $table->timestamps();
        });
        
         Schema::create('subscription_translation', function (Blueprint $table) {
            $table->increments('subscription_translation_id');
            $table->integer('subscription_id')->unsigned();            
            $table->integer('language_id');            
            $table->string('subscription_name', 100);
            $table->foreign('subscription_id')->references('id')->on('subscription')->onDelete('cascade');       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('subscription');
        Schema::drop('subscription_translation');
    }
}
