<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('admins')->delete();

      $admin = array(         
         array(
            'id' => 1,
            'email' => 'admin@mail.com',
            'password' => Hash::make('admin'),
            'name' => 'Administrator',            
            'created_at' => new DateTime,
            'updated_at' => new DateTime
         ));
         DB::table('admins')->insert($admin);
         $language = array(         
         array(
            'id' => 1,
            'lang_name' => 'English',
            'lang_short_code' => 'en',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
         ),array(
            'id' => 2,
            'lang_name' => 'Portuguese',
            'lang_short_code' => 'pt',
            'created_at' => new DateTime,
            'updated_at' => new DateTime
         ));
         DB::table('language')->insert($language);
    }
}
