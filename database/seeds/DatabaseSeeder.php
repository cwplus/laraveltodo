<?php

use Faker\Factory as FackerFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $faker = FackerFactory::create(config('app.locale'));
        for($cpt=0; $cpt<6;$cpt++){
            \App\Models\TodoList::create([
                'name'=> $faker->sentence(3)
            ]);
        }
    }
}
