<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHallAccommodationRelationTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('hall_accommodation_relation', function (Blueprint $table) {
			$table->increments('hall_accommodation_relation_id');
			$table->integer('hall_id')->unsigned();
			$table->integer('accommodation_id')->unsigned();
			$table->string('accommodation_number', 255);
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('hall_accommodation_relation');
	}
}
