<?php

use Illuminate\Database\Seeder;

class HealthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('step')->delete();
        $today = (new DateTime())->add(new DateInterval('P'.'2'.'D'));
        $date = $today;
        $username = 'Mike';
        for($i=0;$i<2500;$i++) {
            DB::table('step')->insert([
                'date'=>$date->format('Y-m-d'),
                'steps'=>random_int(4000,10000),
                'minutes'=>random_int(10,360),
                'username'=> $username
            ]);
            $date = date_sub($today, new DateInterval('P'.'1'.'D'));
        }
    }
}
