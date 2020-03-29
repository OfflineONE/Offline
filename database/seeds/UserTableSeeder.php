<?php

 use Illuminate\Database\Seeder;

 class UserTableSeeder extends Seeder
 {
     public function run()
     {
         factory('App\User')->create([
             'id' => '1',
             'name' => 'admin',
             'email' => 'admin@admin.com',
             'password' => bcrypt('testtest'),
         ]);

         factory('App\User')->create([
             'id' => '2',
             'name' => 'reniar',
             'email' => 'reniar@reniar.com',
             'password' => bcrypt('testtest'),
         ]);

         factory('App\User')->create([
             'id' => '3',
             'name' => 'nitai',
             'email' => 'nitai@nitai.com',
             'password' => bcrypt('testtest'),
         ]);

         factory('App\User', 50)->create();
     }
 }
