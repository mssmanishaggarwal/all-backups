<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHallTypeRelationTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('hall_type_relation', function (Blueprint $table) {
			$table->increments('hall_type_relation_id');
			$table->integer('hall_id')->unsigned();
			$table->integer('hall_type_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('hall_type_relation');
	}
}
