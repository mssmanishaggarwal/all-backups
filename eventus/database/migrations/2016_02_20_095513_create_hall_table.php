<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHallTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('hall', function (Blueprint $table) {
			$table->increments('id');
			$table->enum('is_active', array(0, 1))->default(0);
			$table->timestamps();
		});

		Schema::create('hall_translation', function (Blueprint $table) {
			$table->increments('hall_translation_id');
			$table->integer('hall_id')->unsigned();
			$table->integer('language_id');
			$table->integer('user_id')->unsigned();
			$table->integer('location_id')->unsigned();
			$table->string('hall_name', 255);
			$table->longText('hall_description');
			$table->longText('hall_address');
			$table->string('hall_city', 100);
			$table->integer('hall_province')->unsigned();
			$table->string('hall_postcode', 100);
			$table->string('hall_country', 100);
			$table->float('rental_amount');
			$table->enum('created_by', array('A', 'U'))->default('U');
			$table->foreign('hall_id')->references('id')->on('hall')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('hall');
		Schema::drop('hall_translation');
	}
}
