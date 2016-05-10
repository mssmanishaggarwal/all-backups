<?php

use Illuminate\Database\Seeder;

class Currency extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency')->delete();

      $currency = array(         
         array(
            'id' => 1,
            'currency_name' => 'Kwanza',
            'currency_code' => 'AOA'
         ),
         
         array(
            'id' => 2,
            'currency_name' => 'Euro',
            'currency_code' => 'EUR'
         )
          );
         DB::table('currency')->insert($currency);
    }
}
