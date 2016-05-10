<?php

use Illuminate\Database\Seeder;

class Province extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		DB::table('province')->delete();
		$province = array(
			array(
				'id' => 1,
				'province_name' => 'Bengo',
			), array(
				'id' => 2,
				'province_name' => 'Benguela',
			), array(
				'id' => 3,
				'province_name' => 'Bié',
			), array(
				'id' => 4,
				'province_name' => 'Cuando Cubango',
			), array(
				'id' => 5,
				'province_name' => 'Cuanza Norte',
			), array(
				'id' => 6,
				'province_name' => 'Cuanza Sul',
			), array(
				'id' => 7,
				'province_name' => 'Cunene',
			), array(
				'id' => 8,
				'province_name' => 'Huambo',
			), array(
				'id' => 9,
				'province_name' => 'Huíla',
			), array(
				'id' => 10,
				'province_name' => 'Luanda',
			), array(
				'id' => 11,
				'province_name' => 'Lunda Norte',
			), array(
				'id' => 12,
				'province_name' => 'Lunda Sul',
			), array(
				'id' => 13,
				'province_name' => 'Malanje',
			), array(
				'id' => 14,
				'province_name' => 'Moxico',
			), array(
				'id' => 15,
				'province_name' => 'Namibe',
			), array(
				'id' => 16,
				'province_name' => 'Uíge',
			), array(
				'id' => 17,
				'province_name' => 'Zaire',
			), array(
				'id' => 18,
				'province_name' => 'Portuguese',
			));
		DB::table('province')->insert($province);
	}
}
