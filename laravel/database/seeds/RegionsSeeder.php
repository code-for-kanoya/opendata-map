<?php

use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $param = [];
        $param[0] = ['name' => '北海道'];
        $param[1] = ['name' => '東北'];
        $param[2] = ['name' => '関東'];
        $param[3] = ['name' => '中部'];
        $param[4] = ['name' => '近畿'];
        $param[5] = ['name' => '中国'];
        $param[6] = ['name' => '四国'];
        $param[7] = ['name' => '九州'];
        $param[8] = ['name' => '沖縄'];

        DB::table('regions')->insert($param);
    }
}
