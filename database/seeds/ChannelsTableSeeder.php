<?php

use Illuminate\Database\Seeder;
use App\Channel;

class ChannelsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $t1 = 'Laravel';
            $t2 = 'Vuejs';
            $t3 = 'CSS3';
            $t4 = 'JavaScript';
            $t5 = 'PHP Testing';
            $t6 = 'Spark';
            $t7 = 'ASP.NET';


//        $t1 = 'الباب الأول: الخوارزميات وقواعد البيانات';
//        $t2 = 'الباب الثاني: البرمجيات';
//        $t3 = 'الباب الثالث: الذكاء الصنعي';
//        $t4 = 'الباب الرابع: الشبكات';
//


        $channel1 = ['title' => $t1, 'slug' => str_slug($t1)];
        $channel2 = ['title' => $t2, 'slug' => str_slug($t2)];
        $channel3 = ['title' => $t3, 'slug' => str_slug($t3)];
        $channel4 = ['title' => $t4, 'slug' => str_slug($t4)];
        $channel5 = ['title' => $t5, 'slug' => str_slug($t5)];
        $channel6 = ['title' => $t6, 'slug' => str_slug($t6)];
        $channel7 = ['title' => $t7, 'slug' => str_slug($t7)];

        Channel::create($channel1);
        Channel::create($channel2);
        Channel::create($channel3);
        Channel::create($channel4);
        Channel::create($channel5);
       Channel::create($channel6);
       Channel::create($channel7);
    }
}
