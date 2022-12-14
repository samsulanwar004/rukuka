<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(BackendSeeder::class);
        $this->call(NavContentSeeder::class);
        $this->call(LandingContentSeeder::class);
        $this->call(SeederCountries::class);
    }
}
