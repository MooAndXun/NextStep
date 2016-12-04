<?php

use App\Utils\TimeUtil;
use Illuminate\Database\Seeder;

class SleepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sleep')->delete();
        $today = (new DateTime())->add(new DateInterval('P'.'2'.'D'));
        $date = $today;
        $username = 'Mike';

        for($i=0;$i<200;$i++) {
            $sleep_minutes = random_int(240,600);
            $deep_minutes = random_int(60,$sleep_minutes);
            $sleep_start = TimeUtil::rand_time($today->format('Y-m-d').'00.00.00',$today->format('Y-m-d').'04:00:00');
            DB::table('sleep')->insert([
                'username'=>$username,
                'date'=>$date->format('Y-m-d'),
                'sleep_minutes'=>$sleep_minutes,
                'deep_minutes'=>$deep_minutes,
                'start'=>$sleep_start,
                'end'=>TimeUtil::time_add_minute($sleep_start,$sleep_minutes),
            ]);
            $date = date_sub($today, new DateInterval('P'.'1'.'D'));
        }
    }
}
