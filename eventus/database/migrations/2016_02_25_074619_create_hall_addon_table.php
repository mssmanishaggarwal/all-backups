<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHallAddonTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('hall_addon_relation', function (Blueprint $table) {
			$table->increments('hall_addon_relation_id');
			$table->integer('hall_id')->unsigned();
			$table->integer('addon_id')->unsigned();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('hall_addon_relation');
	}
}
