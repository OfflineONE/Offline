<?php

use Illuminate\Database\Seeder;

class ChannelTableSeeder extends Seeder
{
    public function run()
    {
        factory('App\Channel')->create([
            'name' => 'Creativity',
            'slug' => 'Creativity'
        ]);

        factory('App\Channel')->create([
            'name' => 'Clean Planet',
            'slug' => 'Clean-Planet'
        ]);
        factory('App\Channel')->create([
            'name' => 'Health',
            'slug' => 'Health'
        ]);
        factory('App\Channel')->create([
            'name' => 'Spirituality',
            'slug' => 'Spirituality'
        ]);
    }
}
