<?php

use Illuminate\Database\Seeder;

class ThreadsTableSeeder extends Seeder
{

    public function run()
    {
        factory('App\Thread')->create([
            'user_id' => '1',
            'channel_id' => '1',
            'visits' => '1',
            'title' => 'Administrator testing Title: 1',
            'body' => 'The admin is set on one and will be responsible for standard admin user tests.
            Testing in Channel 1 Creativity with slug Creativity'
        ]);

        factory('App\Thread')->create([
            'user_id' => '1',
            'channel_id' => '2',
            'visits' => '2',
            'title' => 'Administrator testing Title: 2',
            'body' => 'The admin is set on one and will be responsible for standard admin user tests.
            Testing in Channel 2 Clean Planet with Slug Clean-planet'
        ]);

        factory('App\Thread')->create([
            'user_id' => '1',
            'channel_id' => '3',
            'visits' => '3',
            'title' => 'Administrator testing Title: 3',
            'body' => '
             The admin is set on one and will be responsible for standard admin user tests.
             Testing in Channel 3 Health with Slug Health
            '
        ]);

        factory('App\Thread')->create([
            'user_id' => '2',
            'channel_id' => '1',
            'visits' => '100',
            'title' => 'Reniars Creator Test Reniars first post in Channel Creativity',
            'body' => '
             Creativity is the base of success. In our existence there has always only been one purpose and that purpose is creation.
             People who are creating are successful and happy and those who don´t are slaves.
             If our ultimate purpose is to reproduce than the act of reproduction is creation as well.
             Today more than ever we need a guid to pick us up to leave the path of slavery.
             '
        ]);

        factory('App\Thread')->create([
            'user_id' => '2',
            'channel_id' => '1',
            'visits' => '2001230',
            'title' => 'Creativity in the modern world',
            'body' => '
             In all aspects of live we will perform much better if we make creativity a habit.
             Imagine two workers working on the same conveyor belt.
             One selling his time for money and waiting for his shift to end controlled by his mind
             The other one mindfully creating a machine that doe the job for him.
             Who is more successful?
             The creator or the slave?
             '
        ]);

        factory('App\Thread')->create([
            'user_id' => '2',
            'channel_id' => '1',
            'visits' => '32623478',
            'title' => 'How to increase creativity?',
            'body' => '
             Creativity comes from your intuition. Some people call this the infinite intelligence.
             It will only speak to you when the mind is quiet.
             The mind will be quiet if you think and follow your own path.
             If you follow the herd you will live in an illusion of security.
             The herd tells you where to go and provides for you.
             You are a slave.
             You are depended.
             Stop following others.
             Start follow your passion.
             Overcome fear.
             Never chase the money.
            '
        ]);

        factory('App\Thread')->create([
            'user_id' => '3',
            'channel_id' => '3',
            'visits' => '267',
            'title' => 'Nitai testing Title: 1',
            'body' => 'The Nitai will provide content'
        ]);

        factory('App\Thread')->create([
            'user_id' => '3',
            'channel_id' => '3',
            'visits' => '18009',
            'title' => 'Nitai testing Title: 2',
            'body' => 'The Nitai will provide content'
        ]);

        factory('App\Thread')->create([
            'user_id' => '3',
            'channel_id' => '4',
            'visits' => '9',
            'title' => 'Nitai testing Title: 3',
            'body' => 'The Nitai will provide content'
        ]);

//        factory('App\Thread')->create();
//        factory('App\Thread')->create();
//        factory('App\Thread')->create();
//        factory('App\Thread', 30)->create();
    }
}

