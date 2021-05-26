<?php

use Illuminate\Database\Seeder;

class PrefecturesSeeder extends Seeder
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
        $param[0] = ['region_id' => 1, 'name' => '北海道', 'latitude' => 0, 'longitude' => 0];
        $param[1] = ['region_id' => 2, 'name' => '青森県', 'latitude' => 0, 'longitude' => 0];
        $param[2] = ['region_id' => 2, 'name' => '岩手県', 'latitude' => 0, 'longitude' => 0];
        $param[3] = ['region_id' => 2, 'name' => '宮城県', 'latitude' => 0, 'longitude' => 0];
        $param[4] = ['region_id' => 2, 'name' => '秋田県', 'latitude' => 0, 'longitude' => 0];
        $param[5] = ['region_id' => 2, 'name' => '山形県', 'latitude' => 0, 'longitude' => 0];
        $param[6] = ['region_id' => 2, 'name' => '福島県', 'latitude' => 0, 'longitude' => 0];
        $param[7] = ['region_id' => 3, 'name' => '茨城県', 'latitude' => 0, 'longitude' => 0];
        $param[8] = ['region_id' => 3, 'name' => '栃木県', 'latitude' => 0, 'longitude' => 0];
        $param[9] = ['region_id' => 3, 'name' => '群馬県', 'latitude' => 0, 'longitude' => 0];
        $param[10] = ['region_id' => 3, 'name' => '埼玉県', 'latitude' => 0, 'longitude' => 0];
        $param[11] = ['region_id' => 3, 'name' => '千葉県', 'latitude' => 0, 'longitude' => 0];
        $param[12] = ['region_id' => 3, 'name' => '東京都', 'latitude' => 0, 'longitude' => 0];
        $param[13] = ['region_id' => 3, 'name' => '神奈川県', 'latitude' => 0, 'longitude' => 0];
        $param[14] = ['region_id' => 4, 'name' => '新潟県', 'latitude' => 0, 'longitude' => 0];
        $param[15] = ['region_id' => 4, 'name' => '富山県', 'latitude' => 0, 'longitude' => 0];
        $param[16] = ['region_id' => 4, 'name' => '石川県', 'latitude' => 0, 'longitude' => 0];
        $param[17] = ['region_id' => 4, 'name' => '福井県', 'latitude' => 0, 'longitude' => 0];
        $param[18] = ['region_id' => 4, 'name' => '山梨県', 'latitude' => 0, 'longitude' => 0];
        $param[19] = ['region_id' => 4, 'name' => '長野県', 'latitude' => 0, 'longitude' => 0];
        $param[20] = ['region_id' => 4, 'name' => '岐阜県', 'latitude' => 0, 'longitude' => 0];
        $param[21] = ['region_id' => 4, 'name' => '静岡県', 'latitude' => 0, 'longitude' => 0];
        $param[22] = ['region_id' => 4, 'name' => '愛知県', 'latitude' => 0, 'longitude' => 0];
        $param[23] = ['region_id' => 5, 'name' => '三重県', 'latitude' => 0, 'longitude' => 0];
        $param[24] = ['region_id' => 5, 'name' => '滋賀県', 'latitude' => 0, 'longitude' => 0];
        $param[25] = ['region_id' => 5, 'name' => '京都府', 'latitude' => 0, 'longitude' => 0];
        $param[26] = ['region_id' => 5, 'name' => '大阪府', 'latitude' => 0, 'longitude' => 0];
        $param[27] = ['region_id' => 5, 'name' => '兵庫県', 'latitude' => 0, 'longitude' => 0];
        $param[28] = ['region_id' => 5, 'name' => '奈良県', 'latitude' => 0, 'longitude' => 0];
        $param[29] = ['region_id' => 5, 'name' => '和歌山県', 'latitude' => 0, 'longitude' => 0];
        $param[30] = ['region_id' => 6, 'name' => '鳥取県', 'latitude' => 0, 'longitude' => 0];
        $param[31] = ['region_id' => 6, 'name' => '島根県', 'latitude' => 0, 'longitude' => 0];
        $param[32] = ['region_id' => 6, 'name' => '岡山県', 'latitude' => 0, 'longitude' => 0];
        $param[33] = ['region_id' => 6, 'name' => '広島県', 'latitude' => 0, 'longitude' => 0];
        $param[34] = ['region_id' => 6, 'name' => '山口県', 'latitude' => 0, 'longitude' => 0];
        $param[35] = ['region_id' => 7, 'name' => '徳島県', 'latitude' => 0, 'longitude' => 0];
        $param[36] = ['region_id' => 7, 'name' => '香川県', 'latitude' => 0, 'longitude' => 0];
        $param[37] = ['region_id' => 7, 'name' => '愛媛県', 'latitude' => 0, 'longitude' => 0];
        $param[38] = ['region_id' => 7, 'name' => '高知県', 'latitude' => 0, 'longitude' => 0];
        $param[39] = ['region_id' => 8, 'name' => '福岡県', 'latitude' => 33.606457, 'longitude' => 130.418480];
        $param[40] = ['region_id' => 8, 'name' => '佐賀県', 'latitude' => 33.249573, 'longitude' => 130.299308];
        $param[41] = ['region_id' => 8, 'name' => '長崎県', 'latitude' => 32.750517, 'longitude' => 129.868413];
        $param[42] = ['region_id' => 8, 'name' => '熊本県', 'latitude' => 32.789989, 'longitude' => 130.741971];
        $param[43] = ['region_id' => 8, 'name' => '大分県', 'latitude' => 33.238379, 'longitude' => 131.613286];
        $param[44] = ['region_id' => 8, 'name' => '宮崎県', 'latitude' => 31.910986, 'longitude' => 131.424110];
        $param[45] = ['region_id' => 8, 'name' => '鹿児島県', 'latitude' => 31.560540, 'longitude' => 130.558064];
        $param[46] = ['region_id' => 9, 'name' => '沖縄県', 'latitude' => 26.212715, 'longitude' => 127.681093];

        DB::table('prefectures')->insert($param);
    }
}
