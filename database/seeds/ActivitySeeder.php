<?php
use App\Models\User;
use App\Utils\TimeUtil;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: chenm
 * Date: 2016/12/1
 * Time: 9:11
 */
class ActivitySeeder extends \Illuminate\Database\Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $username = User::all(['username']);
        $users = [];
        foreach ($username AS $name) {
            array_push($users, $name['username']);
        }

        for ($i = 0; $i < 10; $i++) {
            DB::table('activity')->insert([
                'name' => $faker->userName,
                'description' => $faker->text,
                'type' => 1,
                'start' => TimeUtil::rand_date('2016-01-01', '2016-05-01'),
                'end' => TimeUtil::rand_date('2016-06-01', '2016-12-31'),
                'people_num' => random_int(16, 32),
                'avatar' => 'activity-1.jpg',
                'creator_username' => array_rand($users),
                'reward' => random_int('10000', '16000')
            ]);
        }
    }
}