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
//        $this->call(UsersTableSeeder::class);
//        $this->call(ActivitySeeder::class);
//        $this->call(HealthSeeder::class);
        $this->call(SleepSeeder::class);
    }
}
