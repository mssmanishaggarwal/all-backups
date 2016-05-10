<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHallimagesTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('hallimages', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('hall_id')->unsigned();
			$table->string('hall_image', 255);
			$table->string('hall_image_caption', 255);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('hallimages');
	}
}
