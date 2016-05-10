<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

      $user = array(         
         array(
            'id' => 1,
            'email' => 'ranjit@mail.com',
            'password' => Hash::make('123456'),
            'first_name' => 'Ranjit',            
            'last_name' => 'kumar',            
            'created_at' => new DateTime,
            'updated_at' => new DateTime
         )
          );
         DB::table('users')->insert($user);
    }
}
