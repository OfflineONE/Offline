<?php

 use Illuminate\Database\Seeder;

 class UserTableSeeder extends Seeder
 {
     public function run()
     {
         factory('App\User')->create([
             'id' => '1',
             'name' => 'nobody',
             'email' => env('ADMIN_1'),
             'password' => bcrypt(env('PW_1')),
         ]);

         factory('App\User')->create([
             'id' => '2',
             'name' => 'reniar',
             'email' => env('ADMIN_2'),
             'password' => bcrypt(env('PW_1')),
         ]);

         factory('App\User')->create([
             'id' => '3',
             'name' => 'nitai',
             'email' => env('ADMIN_3'),
             'password' => bcrypt(env('PW_1')),
         ]);

//         factory('App\User', 50)->create();
     }
 }
