<?php

use Illuminate\Database\Seeder;

class MunicipalitiesSeeder extends Seeder
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
        $param[0] = ['prefecture_id' => 40, 'name' => '北九州市', 'code' => '401005', 'latitude' => 33.883498, 'longitude' => 130.875177];
        $param[1] = ['prefecture_id' => 40, 'name' => '福岡市', 'code' => '401307', 'latitude' => 33.590198, 'longitude' => 130.401719];
        $param[2] = ['prefecture_id' => 40, 'name' => '大牟田市', 'code' => '402028', 'latitude' => 33.030232, 'longitude' => 130.445953];
        $param[3] = ['prefecture_id' => 40, 'name' => '久留米市', 'code' => '402036', 'latitude' => 33.319256, 'longitude' => 130.508348];
        $param[4] = ['prefecture_id' => 40, 'name' => '直方市', 'code' => '402044', 'latitude' => 33.744214, 'longitude' => 130.729627];
        $param[5] = ['prefecture_id' => 40, 'name' => '飯塚市', 'code' => '402052', 'latitude' => 33.646563, 'longitude' => 130.69118];
        $param[6] = ['prefecture_id' => 40, 'name' => '田川市', 'code' => '402061', 'latitude' => 33.638843, 'longitude' => 130.806179];
        $param[7] = ['prefecture_id' => 40, 'name' => '柳川市', 'code' => '402079', 'latitude' => 33.163101, 'longitude' => 130.405812];
        $param[8] = ['prefecture_id' => 40, 'name' => '八女市', 'code' => '402109', 'latitude' => 33.211956, 'longitude' => 130.557932];
        $param[9] = ['prefecture_id' => 40, 'name' => '筑後市', 'code' => '402117', 'latitude' => 33.212399, 'longitude' => 130.501961];
        $param[10] = ['prefecture_id' => 40, 'name' => '大川市', 'code' => '402125', 'latitude' => 33.206618, 'longitude' => 130.384004];
        $param[11] = ['prefecture_id' => 40, 'name' => '行橋市', 'code' => '402133', 'latitude' => 33.728828, 'longitude' => 130.983009];
        $param[12] = ['prefecture_id' => 40, 'name' => '豊前市', 'code' => '402141', 'latitude' => 33.611513, 'longitude' => 131.13005];
        $param[13] = ['prefecture_id' => 40, 'name' => '中間市', 'code' => '402150', 'latitude' => 33.816649, 'longitude' => 130.709041];
        $param[14] = ['prefecture_id' => 40, 'name' => '小郡市', 'code' => '402168', 'latitude' => 33.396401, 'longitude' => 130.555537];
        $param[15] = ['prefecture_id' => 40, 'name' => '筑紫野市', 'code' => '402176', 'latitude' => 33.487588, 'longitude' => 130.52588];
        $param[16] = ['prefecture_id' => 40, 'name' => '春日市', 'code' => '402184', 'latitude' => 33.532807, 'longitude' => 130.47023];
        $param[17] = ['prefecture_id' => 40, 'name' => '大野城市', 'code' => '402192', 'latitude' => 33.536289, 'longitude' => 130.478836];
        $param[18] = ['prefecture_id' => 40, 'name' => '宗像市', 'code' => '402206', 'latitude' => 33.805552, 'longitude' => 130.540683];
        $param[19] = ['prefecture_id' => 40, 'name' => '太宰府市', 'code' => '402214', 'latitude' => 33.512793, 'longitude' => 130.523915];
        $param[20] = ['prefecture_id' => 40, 'name' => '古賀市', 'code' => '402231', 'latitude' => 33.728823, 'longitude' => 130.470001];
        $param[21] = ['prefecture_id' => 40, 'name' => '福津市', 'code' => '402249', 'latitude' => 33.766763, 'longitude' => 130.491062];
        $param[22] = ['prefecture_id' => 40, 'name' => 'うきは市', 'code' => '402257', 'latitude' => 33.347449, 'longitude' => 130.755003];
        $param[23] = ['prefecture_id' => 40, 'name' => '宮若市', 'code' => '402265', 'latitude' => 33.723501, 'longitude' => 130.666477];
        $param[24] = ['prefecture_id' => 40, 'name' => '嘉麻市', 'code' => '402273', 'latitude' => 33.563307, 'longitude' => 130.711616];
        $param[25] = ['prefecture_id' => 40, 'name' => '朝倉市', 'code' => '402281', 'latitude' => 33.423414, 'longitude' => 130.665574];
        $param[26] = ['prefecture_id' => 40, 'name' => 'みやま市', 'code' => '402290', 'latitude' => 33.152427, 'longitude' => 130.474614];
        $param[27] = ['prefecture_id' => 40, 'name' => '糸島市', 'code' => '402303', 'latitude' => 33.557302, 'longitude' => 130.19553];
        $param[28] = ['prefecture_id' => 40, 'name' => '那珂川市', 'code' => '402311', 'latitude' => 33.499595, 'longitude' => 130.422157];
        $param[29] = ['prefecture_id' => 40, 'name' => '宇美町', 'code' => '403415', 'latitude' => 33.567738, 'longitude' => 130.5112];
        $param[30] = ['prefecture_id' => 40, 'name' => '篠栗町', 'code' => '403423', 'latitude' => 33.623961, 'longitude' => 130.526209];
        $param[31] = ['prefecture_id' => 40, 'name' => '志免町', 'code' => '403431', 'latitude' => 33.591404, 'longitude' => 130.47973];
        $param[32] = ['prefecture_id' => 40, 'name' => '須恵町', 'code' => '403440', 'latitude' => 33.587261, 'longitude' => 130.507238];
        $param[33] = ['prefecture_id' => 40, 'name' => '新宮町', 'code' => '403458', 'latitude' => 33.715311, 'longitude' => 130.446536];
        $param[34] = ['prefecture_id' => 40, 'name' => '久山町', 'code' => '403482', 'latitude' => 33.646728, 'longitude' => 130.499881];
        $param[35] = ['prefecture_id' => 40, 'name' => '粕屋町', 'code' => '403491', 'latitude' => 33.61073, 'longitude' => 130.480559];
        $param[36] = ['prefecture_id' => 40, 'name' => '芦屋町', 'code' => '403814', 'latitude' => 33.893854, 'longitude' => 130.663884];
        $param[37] = ['prefecture_id' => 40, 'name' => '水巻町', 'code' => '403822', 'latitude' => 33.854787, 'longitude' => 130.694922];
        $param[38] = ['prefecture_id' => 40, 'name' => '岡垣町', 'code' => '403831', 'latitude' => 33.853398, 'longitude' => 130.611633];
        $param[39] = ['prefecture_id' => 40, 'name' => '遠賀町', 'code' => '403849', 'latitude' => 33.847989, 'longitude' => 130.668448];
        $param[40] = ['prefecture_id' => 40, 'name' => '小竹町', 'code' => '404012', 'latitude' => 33.692235, 'longitude' => 130.712898];
        $param[41] = ['prefecture_id' => 40, 'name' => '鞍手町', 'code' => '404021', 'latitude' => 33.792221, 'longitude' => 130.673975];
        $param[42] = ['prefecture_id' => 40, 'name' => '桂川町', 'code' => '404217', 'latitude' => 33.578894, 'longitude' => 130.678115];
        $param[43] = ['prefecture_id' => 40, 'name' => '筑前町', 'code' => '404471', 'latitude' => 33.457054, 'longitude' => 130.595158];
        $param[44] = ['prefecture_id' => 40, 'name' => '東峰村', 'code' => '404489', 'latitude' => 33.464309, 'longitude' => 130.825861];
        $param[45] = ['prefecture_id' => 40, 'name' => '大刀洗町', 'code' => '405035', 'latitude' => 33.372378, 'longitude' => 130.622586];
        $param[46] = ['prefecture_id' => 40, 'name' => '大木町', 'code' => '405221', 'latitude' => 33.210471, 'longitude' => 130.439738];
        $param[47] = ['prefecture_id' => 40, 'name' => '広川町', 'code' => '405442', 'latitude' => 33.241601, 'longitude' => 130.551467];
        $param[48] = ['prefecture_id' => 40, 'name' => '香春町', 'code' => '406015', 'latitude' => 33.668048, 'longitude' => 130.847478];
        $param[49] = ['prefecture_id' => 40, 'name' => '添田町', 'code' => '406023', 'latitude' => 33.571837, 'longitude' => 130.854084];
        $param[50] = ['prefecture_id' => 40, 'name' => '糸田町', 'code' => '406040', 'latitude' => 33.652745, 'longitude' => 130.779044];
        $param[51] = ['prefecture_id' => 40, 'name' => '川崎町', 'code' => '406058', 'latitude' => 33.599959, 'longitude' => 130.814914];
        $param[52] = ['prefecture_id' => 40, 'name' => '大任町', 'code' => '406082', 'latitude' => 33.612175, 'longitude' => 130.853776];
        $param[53] = ['prefecture_id' => 40, 'name' => '赤村', 'code' => '406091', 'latitude' => 33.616703, 'longitude' => 130.870836];
        $param[54] = ['prefecture_id' => 40, 'name' => '福智町', 'code' => '406104', 'latitude' => 33.683206, 'longitude' => 130.780121];
        $param[55] = ['prefecture_id' => 40, 'name' => '苅田町', 'code' => '406210', 'latitude' => 33.775974, 'longitude' => 130.980512];
        $param[56] = ['prefecture_id' => 40, 'name' => 'みやこ町', 'code' => '406252', 'latitude' => 33.699242, 'longitude' => 130.920096];
        $param[57] = ['prefecture_id' => 40, 'name' => '吉富町', 'code' => '406422', 'latitude' => 33.602646, 'longitude' => 131.175951];
        $param[58] = ['prefecture_id' => 40, 'name' => '上毛町', 'code' => '406465', 'latitude' => 33.57872, 'longitude' => 131.164352];
        $param[59] = ['prefecture_id' => 40, 'name' => '築上町', 'code' => '406473', 'latitude' => 33.656146, 'longitude' => 131.05604];
        $param[60] = ['prefecture_id' => 41, 'name' => '佐賀市', 'code' => '412015', 'latitude' => 33.263505, 'longitude' => 130.300726];
        $param[61] = ['prefecture_id' => 41, 'name' => '唐津市', 'code' => '412023', 'latitude' => 33.450115, 'longitude' => 129.968126];
        $param[62] = ['prefecture_id' => 41, 'name' => '鳥栖市', 'code' => '412031', 'latitude' => 33.37752, 'longitude' => 130.506097];
        $param[63] = ['prefecture_id' => 41, 'name' => '多久市', 'code' => '412040', 'latitude' => 33.288438, 'longitude' => 130.110226];
        $param[64] = ['prefecture_id' => 41, 'name' => '伊万里市', 'code' => '412058', 'latitude' => 33.264667, 'longitude' => 129.880451];
        $param[65] = ['prefecture_id' => 41, 'name' => '武雄市', 'code' => '412066', 'latitude' => 33.194751, 'longitude' => 130.021575];
        $param[66] = ['prefecture_id' => 41, 'name' => '鹿島市', 'code' => '412074', 'latitude' => 33.103758, 'longitude' => 130.09859];
        $param[67] = ['prefecture_id' => 41, 'name' => '小城市', 'code' => '412082', 'latitude' => 33.27367, 'longitude' => 130.216747];
        $param[68] = ['prefecture_id' => 41, 'name' => '嬉野市', 'code' => '412091', 'latitude' => 33.100892, 'longitude' => 129.987055];
        $param[69] = ['prefecture_id' => 41, 'name' => '神埼市', 'code' => '412104', 'latitude' => 33.311902, 'longitude' => 130.371464];
        $param[70] = ['prefecture_id' => 41, 'name' => '吉野ヶ里町', 'code' => '413275', 'latitude' => 33.321151, 'longitude' => 130.398753];
        $param[71] = ['prefecture_id' => 41, 'name' => '基山町', 'code' => '413411', 'latitude' => 33.427004, 'longitude' => 130.523165];
        $param[72] = ['prefecture_id' => 41, 'name' => '上峰町', 'code' => '413453', 'latitude' => 33.319634, 'longitude' => 130.426204];
        $param[73] = ['prefecture_id' => 41, 'name' => 'みやき町', 'code' => '413461', 'latitude' => 33.324943, 'longitude' => 130.454637];
        $param[74] = ['prefecture_id' => 41, 'name' => '玄海町', 'code' => '413879', 'latitude' => 33.47206, 'longitude' => 129.875105];
        $param[75] = ['prefecture_id' => 41, 'name' => '有田町', 'code' => '414018', 'latitude' => 33.210577, 'longitude' => 129.849012];
        $param[76] = ['prefecture_id' => 41, 'name' => '大町町', 'code' => '414239', 'latitude' => 33.213759, 'longitude' => 130.1161];
        $param[77] = ['prefecture_id' => 41, 'name' => '江北町', 'code' => '414247', 'latitude' => 33.220642, 'longitude' => 130.157403];
        $param[78] = ['prefecture_id' => 41, 'name' => '白石町', 'code' => '414255', 'latitude' => 33.181082, 'longitude' => 130.143493];
        $param[79] = ['prefecture_id' => 41, 'name' => '太良町', 'code' => '414417', 'latitude' => 33.019489, 'longitude' => 130.179149];
        $param[80] = ['prefecture_id' => 42, 'name' => '長崎市', 'code' => '422011', 'latitude' => 32.75019, 'longitude' => 129.877819];
        $param[81] = ['prefecture_id' => 42, 'name' => '佐世保市', 'code' => '422029', 'latitude' => 33.18003, 'longitude' => 129.715105];
        $param[82] = ['prefecture_id' => 42, 'name' => '島原市', 'code' => '422037', 'latitude' => 32.787905, 'longitude' => 130.370031];
        $param[83] = ['prefecture_id' => 42, 'name' => '諫早市', 'code' => '422045', 'latitude' => 32.84359, 'longitude' => 130.053257];
        $param[84] = ['prefecture_id' => 42, 'name' => '大村市', 'code' => '422053', 'latitude' => 32.900034, 'longitude' => 129.95843];
        $param[85] = ['prefecture_id' => 42, 'name' => '平戸市', 'code' => '422070', 'latitude' => 33.368067, 'longitude' => 129.553677];
        $param[86] = ['prefecture_id' => 42, 'name' => '松浦市', 'code' => '422088', 'latitude' => 33.341026, 'longitude' => 129.709047];
        $param[87] = ['prefecture_id' => 42, 'name' => '対馬市', 'code' => '422096', 'latitude' => 34.202646, 'longitude' => 129.287521];
        $param[88] = ['prefecture_id' => 42, 'name' => '壱岐市', 'code' => '422100', 'latitude' => 33.749967, 'longitude' => 129.691357];
        $param[89] = ['prefecture_id' => 42, 'name' => '五島市', 'code' => '422118', 'latitude' => 32.695541, 'longitude' => 128.840815];
        $param[90] = ['prefecture_id' => 42, 'name' => '西海市', 'code' => '422126', 'latitude' => 32.932932, 'longitude' => 129.6429];
        $param[91] = ['prefecture_id' => 42, 'name' => '雲仙市', 'code' => '422134', 'latitude' => 32.835217, 'longitude' => 130.187511];
        $param[92] = ['prefecture_id' => 42, 'name' => '南島原市', 'code' => '422142', 'latitude' => 32.659864, 'longitude' => 130.297837];
        $param[93] = ['prefecture_id' => 42, 'name' => '長与町', 'code' => '423076', 'latitude' => 32.824989, 'longitude' => 129.874948];
        $param[94] = ['prefecture_id' => 42, 'name' => '時津町', 'code' => '423084', 'latitude' => 32.828751, 'longitude' => 129.848546];
        $param[95] = ['prefecture_id' => 42, 'name' => '東彼杵町', 'code' => '423211', 'latitude' => 33.037034, 'longitude' => 129.917149];
        $param[96] = ['prefecture_id' => 42, 'name' => '川棚町', 'code' => '423220', 'latitude' => 33.072664, 'longitude' => 129.861551];
        $param[97] = ['prefecture_id' => 42, 'name' => '波佐見町', 'code' => '423238', 'latitude' => 33.137893, 'longitude' => 129.895548];
        $param[98] = ['prefecture_id' => 42, 'name' => '小値賀町', 'code' => '423831', 'latitude' => 33.191017, 'longitude' => 129.058833];
        $param[99] = ['prefecture_id' => 42, 'name' => '佐々町', 'code' => '423912', 'latitude' => 33.238426, 'longitude' => 129.650353];
        $param[100] = ['prefecture_id' => 42, 'name' => '新上五島町', 'code' => '424111', 'latitude' => 32.984597, 'longitude' => 129.073453];
        $param[101] = ['prefecture_id' => 43, 'name' => '熊本市', 'code' => '431001', 'latitude' => 32.803076, 'longitude' => 130.707875];
        $param[102] = ['prefecture_id' => 43, 'name' => '八代市', 'code' => '432024', 'latitude' => 32.508313, 'longitude' => 130.60175];
        $param[103] = ['prefecture_id' => 43, 'name' => '人吉市', 'code' => '432032', 'latitude' => 32.21678, 'longitude' => 130.739602];
        $param[104] = ['prefecture_id' => 43, 'name' => '荒尾市', 'code' => '432041', 'latitude' => 32.986712, 'longitude' => 130.433014];
        $param[105] = ['prefecture_id' => 43, 'name' => '水俣市', 'code' => '432059', 'latitude' => 32.211821, 'longitude' => 130.408715];
        $param[106] = ['prefecture_id' => 43, 'name' => '玉名市', 'code' => '432067', 'latitude' => 32.934593, 'longitude' => 130.562578];
        $param[107] = ['prefecture_id' => 43, 'name' => '山鹿市', 'code' => '432083', 'latitude' => 33.017632, 'longitude' => 130.69128];
        $param[108] = ['prefecture_id' => 43, 'name' => '菊池市', 'code' => '432105', 'latitude' => 32.979525, 'longitude' => 130.813119];
        $param[109] = ['prefecture_id' => 43, 'name' => '宇土市', 'code' => '432113', 'latitude' => 32.68797, 'longitude' => 130.659725];
        $param[110] = ['prefecture_id' => 43, 'name' => '上天草市', 'code' => '432121', 'latitude' => 32.587382, 'longitude' => 130.430457];
        $param[111] = ['prefecture_id' => 43, 'name' => '宇城市', 'code' => '432130', 'latitude' => 32.647911, 'longitude' => 130.684293];
        $param[112] = ['prefecture_id' => 43, 'name' => '阿蘇市', 'code' => '432148', 'latitude' => 32.952076, 'longitude' => 131.121278];
        $param[113] = ['prefecture_id' => 43, 'name' => '天草市', 'code' => '432156', 'latitude' => 32.458457, 'longitude' => 130.193344];
        $param[114] = ['prefecture_id' => 43, 'name' => '合志市', 'code' => '432164', 'latitude' => 32.885961, 'longitude' => 130.789697];
        $param[115] = ['prefecture_id' => 43, 'name' => '美里町', 'code' => '433489', 'latitude' => 32.6397, 'longitude' => 130.788901];
        $param[116] = ['prefecture_id' => 43, 'name' => '玉東町', 'code' => '433641', 'latitude' => 32.918902, 'longitude' => 130.628546];
        $param[117] = ['prefecture_id' => 43, 'name' => '南関町', 'code' => '433675', 'latitude' => 33.061605, 'longitude' => 130.540972];
        $param[118] = ['prefecture_id' => 43, 'name' => '長洲町', 'code' => '433683', 'latitude' => 32.929756, 'longitude' => 130.452703];
        $param[119] = ['prefecture_id' => 43, 'name' => '和水町', 'code' => '433691', 'latitude' => 32.978104, 'longitude' => 130.605825];
        $param[120] = ['prefecture_id' => 43, 'name' => '大津町', 'code' => '434035', 'latitude' => 32.878491, 'longitude' => 130.86814];
        $param[121] = ['prefecture_id' => 43, 'name' => '菊陽町', 'code' => '434043', 'latitude' => 32.862494, 'longitude' => 130.828657];
        $param[122] = ['prefecture_id' => 43, 'name' => '南小国町', 'code' => '434230', 'latitude' => 33.098632, 'longitude' => 131.070479];
        $param[123] = ['prefecture_id' => 43, 'name' => '小国町', 'code' => '434248', 'latitude' => 33.121582, 'longitude' => 131.068152];
        $param[124] = ['prefecture_id' => 43, 'name' => '産山村', 'code' => '434256', 'latitude' => 32.995747, 'longitude' => 131.216583];
        $param[125] = ['prefecture_id' => 43, 'name' => '高森町', 'code' => '434281', 'latitude' => 32.827509, 'longitude' => 131.121753];
        $param[126] = ['prefecture_id' => 43, 'name' => '西原村', 'code' => '434329', 'latitude' => 32.834814, 'longitude' => 130.903007];
        $param[127] = ['prefecture_id' => 43, 'name' => '南阿蘇村', 'code' => '434337', 'latitude' => 32.845101, 'longitude' => 131.017771];
        $param[128] = ['prefecture_id' => 43, 'name' => '御船町', 'code' => '434418', 'latitude' => 32.714554, 'longitude' => 130.801936];
        $param[129] = ['prefecture_id' => 43, 'name' => '嘉島町', 'code' => '434426', 'latitude' => 32.740076, 'longitude' => 130.757166];
        $param[130] = ['prefecture_id' => 43, 'name' => '益城町', 'code' => '434434', 'latitude' => 32.80038, 'longitude' => 130.817345];
        $param[131] = ['prefecture_id' => 43, 'name' => '甲佐町', 'code' => '434442', 'latitude' => 32.651216, 'longitude' => 130.811231];
        $param[132] = ['prefecture_id' => 43, 'name' => '山都町', 'code' => '434477', 'latitude' => 32.685268, 'longitude' => 130.990253];
        $param[133] = ['prefecture_id' => 43, 'name' => '氷川町', 'code' => '434680', 'latitude' => 32.582453, 'longitude' => 130.673737];
        $param[134] = ['prefecture_id' => 43, 'name' => '芦北町', 'code' => '434825', 'latitude' => 32.299103, 'longitude' => 130.49312];
        $param[135] = ['prefecture_id' => 43, 'name' => '津奈木町', 'code' => '434841', 'latitude' => 32.233879, 'longitude' => 130.439656];
        $param[136] = ['prefecture_id' => 43, 'name' => '錦町', 'code' => '435015', 'latitude' => 32.201302, 'longitude' => 130.840179];
        $param[137] = ['prefecture_id' => 43, 'name' => '多良木町', 'code' => '435058', 'latitude' => 32.263711, 'longitude' => 130.935506];
        $param[138] = ['prefecture_id' => 43, 'name' => '湯前町', 'code' => '435066', 'latitude' => 32.276281, 'longitude' => 130.980902];
        $param[139] = ['prefecture_id' => 43, 'name' => '水上村', 'code' => '435074', 'latitude' => 32.313488, 'longitude' => 131.008623];
        $param[140] = ['prefecture_id' => 43, 'name' => '相良村', 'code' => '435104', 'latitude' => 32.235698, 'longitude' => 130.797933];
        $param[141] = ['prefecture_id' => 43, 'name' => '五木村', 'code' => '435112', 'latitude' => 32.397353, 'longitude' => 130.827827];
        $param[142] = ['prefecture_id' => 43, 'name' => '山江村', 'code' => '435121', 'latitude' => 32.246828, 'longitude' => 130.766733];
        $param[143] = ['prefecture_id' => 43, 'name' => '球磨村', 'code' => '435139', 'latitude' => 32.252285, 'longitude' => 130.651199];
        $param[144] = ['prefecture_id' => 43, 'name' => 'あさぎり町', 'code' => '435147', 'latitude' => 32.240317, 'longitude' => 130.89781];
        $param[145] = ['prefecture_id' => 43, 'name' => '苓北町', 'code' => '435317', 'latitude' => 32.513195, 'longitude' => 130.054906];
        $param[146] = ['prefecture_id' => 44, 'name' => '大分市', 'code' => '442011', 'latitude' => 33.239488, 'longitude' => 131.609113];
        $param[147] = ['prefecture_id' => 44, 'name' => '別府市', 'code' => '442020', 'latitude' => 33.284492, 'longitude' => 131.491173];
        $param[148] = ['prefecture_id' => 44, 'name' => '中津市', 'code' => '442038', 'latitude' => 33.598232, 'longitude' => 131.188172];
        $param[149] = ['prefecture_id' => 44, 'name' => '日田市', 'code' => '442046', 'latitude' => 33.321195, 'longitude' => 130.941296];
        $param[150] = ['prefecture_id' => 44, 'name' => '佐伯市', 'code' => '442054', 'latitude' => 32.959734, 'longitude' => 131.900154];
        $param[151] = ['prefecture_id' => 44, 'name' => '臼杵市', 'code' => '442062', 'latitude' => 33.125919, 'longitude' => 131.804714];
        $param[152] = ['prefecture_id' => 44, 'name' => '津久見市', 'code' => '442071', 'latitude' => 33.072185, 'longitude' => 131.861276];
        $param[153] = ['prefecture_id' => 44, 'name' => '竹田市', 'code' => '442089', 'latitude' => 32.97373, 'longitude' => 131.397991];
        $param[154] = ['prefecture_id' => 44, 'name' => '豊後高田市', 'code' => '442097', 'latitude' => 33.556173, 'longitude' => 131.447046];
        $param[155] = ['prefecture_id' => 44, 'name' => '杵築市', 'code' => '442101', 'latitude' => 33.417116, 'longitude' => 131.616083];
        $param[156] = ['prefecture_id' => 44, 'name' => '宇佐市', 'code' => '442119', 'latitude' => 33.531904, 'longitude' => 131.349567];
        $param[157] = ['prefecture_id' => 44, 'name' => '豊後大野市', 'code' => '442127', 'latitude' => 32.977511, 'longitude' => 131.584188];
        $param[158] = ['prefecture_id' => 44, 'name' => '由布市', 'code' => '442135', 'latitude' => 33.179996, 'longitude' => 131.426792];
        $param[159] = ['prefecture_id' => 44, 'name' => '国東市', 'code' => '442143', 'latitude' => 33.563333, 'longitude' => 131.732385];
        $param[160] = ['prefecture_id' => 44, 'name' => '姫島村', 'code' => '443221', 'latitude' => 33.724537, 'longitude' => 131.645142];
        $param[161] = ['prefecture_id' => 44, 'name' => '日出町', 'code' => '443417', 'latitude' => 33.369256, 'longitude' => 131.532325];
        $param[162] = ['prefecture_id' => 44, 'name' => '九重町', 'code' => '444618', 'latitude' => 33.228577, 'longitude' => 131.188705];
        $param[163] = ['prefecture_id' => 44, 'name' => '玖珠町', 'code' => '444626', 'latitude' => 33.283199, 'longitude' => 131.151478];
        $param[164] = ['prefecture_id' => 45, 'name' => '宮崎市', 'code' => '452017', 'latitude' => 31.907729, 'longitude' => 131.42022];
        $param[165] = ['prefecture_id' => 45, 'name' => '都城市', 'code' => '452025', 'latitude' => 31.719543, 'longitude' => 131.061519];
        $param[166] = ['prefecture_id' => 45, 'name' => '延岡市', 'code' => '452033', 'latitude' => 32.581957, 'longitude' => 131.665132];
        $param[167] = ['prefecture_id' => 45, 'name' => '日南市', 'code' => '452041', 'latitude' => 31.601355, 'longitude' => 131.378363];
        $param[168] = ['prefecture_id' => 45, 'name' => '小林市', 'code' => '452050', 'latitude' => 31.996779, 'longitude' => 130.973069];
        $param[169] = ['prefecture_id' => 45, 'name' => '日向市', 'code' => '452068', 'latitude' => 32.422468, 'longitude' => 131.624371];
        $param[170] = ['prefecture_id' => 45, 'name' => '串間市', 'code' => '452076', 'latitude' => 31.464595, 'longitude' => 131.228442];
        $param[171] = ['prefecture_id' => 45, 'name' => '西都市', 'code' => '452084', 'latitude' => 32.108565, 'longitude' => 131.401266];
        $param[172] = ['prefecture_id' => 45, 'name' => 'えびの市', 'code' => '452092', 'latitude' => 32.04535, 'longitude' => 130.810841];
        $param[173] = ['prefecture_id' => 45, 'name' => '三股町', 'code' => '453412', 'latitude' => 31.730688, 'longitude' => 131.124924];
        $param[174] = ['prefecture_id' => 45, 'name' => '高原町', 'code' => '453617', 'latitude' => 31.928395, 'longitude' => 131.007953];
        $param[175] = ['prefecture_id' => 45, 'name' => '国富町', 'code' => '453820', 'latitude' => 31.990649, 'longitude' => 131.323535];
        $param[176] = ['prefecture_id' => 45, 'name' => '綾町', 'code' => '453838', 'latitude' => 31.999064, 'longitude' => 131.252969];
        $param[177] = ['prefecture_id' => 45, 'name' => '高鍋町', 'code' => '454010', 'latitude' => 32.127981, 'longitude' => 131.503276];
        $param[178] = ['prefecture_id' => 45, 'name' => '新富町', 'code' => '454028', 'latitude' => 32.06892, 'longitude' => 131.488023];
        $param[179] = ['prefecture_id' => 45, 'name' => '西米良村', 'code' => '454036', 'latitude' => 32.226332, 'longitude' => 131.154433];
        $param[180] = ['prefecture_id' => 45, 'name' => '木城町', 'code' => '454044', 'latitude' => 32.163888, 'longitude' => 131.473423];
        $param[181] = ['prefecture_id' => 45, 'name' => '川南町', 'code' => '454052', 'latitude' => 32.192056, 'longitude' => 131.525931];
        $param[182] = ['prefecture_id' => 45, 'name' => '都農町', 'code' => '454061', 'latitude' => 32.256498, 'longitude' => 131.559718];
        $param[183] = ['prefecture_id' => 45, 'name' => '門川町', 'code' => '454214', 'latitude' => 32.46979, 'longitude' => 131.648725];
        $param[184] = ['prefecture_id' => 45, 'name' => '諸塚村', 'code' => '454290', 'latitude' => 32.512392, 'longitude' => 131.330416];
        $param[185] = ['prefecture_id' => 45, 'name' => '椎葉村', 'code' => '454303', 'latitude' => 32.467453, 'longitude' => 131.158241];
        $param[186] = ['prefecture_id' => 45, 'name' => '美郷町', 'code' => '454311', 'latitude' => 32.440012, 'longitude' => 131.422789];
        $param[187] = ['prefecture_id' => 45, 'name' => '高千穂町', 'code' => '454419', 'latitude' => 32.711738, 'longitude' => 131.307797];
        $param[188] = ['prefecture_id' => 45, 'name' => '日之影町', 'code' => '454427', 'latitude' => 32.653802, 'longitude' => 131.38814];
        $param[189] = ['prefecture_id' => 45, 'name' => '五ヶ瀬町', 'code' => '454435', 'latitude' => 32.682957, 'longitude' => 131.196522];
        $param[190] = ['prefecture_id' => 46, 'name' => '鹿児島市', 'code' => '462012', 'latitude' => 31.596545, 'longitude' => 130.557102];
        $param[191] = ['prefecture_id' => 46, 'name' => '鹿屋市', 'code' => '462039', 'latitude' => 31.378205, 'longitude' => 130.852177];
        $param[192] = ['prefecture_id' => 46, 'name' => '枕崎市', 'code' => '462047', 'latitude' => 31.272901, 'longitude' => 130.296905];
        $param[193] = ['prefecture_id' => 46, 'name' => '阿久根市', 'code' => '462063', 'latitude' => 32.014197, 'longitude' => 130.192727];
        $param[194] = ['prefecture_id' => 46, 'name' => '出水市', 'code' => '462080', 'latitude' => 32.090458, 'longitude' => 130.352647];
        $param[195] = ['prefecture_id' => 46, 'name' => '指宿市', 'code' => '462101', 'latitude' => 31.25256, 'longitude' => 130.633112];
        $param[196] = ['prefecture_id' => 46, 'name' => '西之表市', 'code' => '462136', 'latitude' => 30.7325, 'longitude' => 130.996944];
        $param[197] = ['prefecture_id' => 46, 'name' => '垂水市', 'code' => '462144', 'latitude' => 31.492862, 'longitude' => 130.700797];
        $param[198] = ['prefecture_id' => 46, 'name' => '薩摩川内市', 'code' => '462152', 'latitude' => 31.813489, 'longitude' => 130.303956];
        $param[199] = ['prefecture_id' => 46, 'name' => '日置市', 'code' => '462161', 'latitude' => 31.633711, 'longitude' => 130.402438];
        $param[200] = ['prefecture_id' => 46, 'name' => '曽於市', 'code' => '462179', 'latitude' => 31.653461, 'longitude' => 131.019221];
        $param[201] = ['prefecture_id' => 46, 'name' => '霧島市', 'code' => '462187', 'latitude' => 31.74099, 'longitude' => 130.763057];
        $param[202] = ['prefecture_id' => 46, 'name' => 'いちき串木野市', 'code' => '462195', 'latitude' => 31.714579, 'longitude' => 130.272036];
        $param[203] = ['prefecture_id' => 46, 'name' => '南さつま市', 'code' => '462209', 'latitude' => 31.416601, 'longitude' => 130.323485];
        $param[204] = ['prefecture_id' => 46, 'name' => '志布志市', 'code' => '462217', 'latitude' => 31.495413, 'longitude' => 131.045416];
        $param[205] = ['prefecture_id' => 46, 'name' => '奄美市', 'code' => '462225', 'latitude' => 28.377647, 'longitude' => 129.493973];
        $param[206] = ['prefecture_id' => 46, 'name' => '南九州市', 'code' => '462233', 'latitude' => 31.378318, 'longitude' => 130.441659];
        $param[207] = ['prefecture_id' => 46, 'name' => '伊佐市', 'code' => '462241', 'latitude' => 32.057195, 'longitude' => 130.613066];
        $param[208] = ['prefecture_id' => 46, 'name' => '姶良市', 'code' => '462250', 'latitude' => 31.728221, 'longitude' => 130.62782];
        $param[209] = ['prefecture_id' => 46, 'name' => '三島村', 'code' => '463035', 'latitude' => 30.780345, 'longitude' => 130.28018];
        $param[210] = ['prefecture_id' => 46, 'name' => '十島村', 'code' => '463043', 'latitude' => 29.837814, 'longitude' => 129.853513];
        $param[211] = ['prefecture_id' => 46, 'name' => 'さつま町', 'code' => '463922', 'latitude' => 31.905709, 'longitude' => 130.455662];
        $param[212] = ['prefecture_id' => 46, 'name' => '長島町', 'code' => '464040', 'latitude' => 32.199417, 'longitude' => 130.177394];
        $param[213] = ['prefecture_id' => 46, 'name' => '湧水町', 'code' => '464520', 'latitude' => 31.951686, 'longitude' => 130.721063];
        $param[214] = ['prefecture_id' => 46, 'name' => '大崎町', 'code' => '464686', 'latitude' => 31.429185, 'longitude' => 131.005799];
        $param[215] = ['prefecture_id' => 46, 'name' => '東串良町', 'code' => '464821', 'latitude' => 31.385545, 'longitude' => 130.973478];
        $param[216] = ['prefecture_id' => 46, 'name' => '錦江町', 'code' => '464902', 'latitude' => 31.243572, 'longitude' => 130.787615];
        $param[217] = ['prefecture_id' => 46, 'name' => '南大隅町', 'code' => '464911', 'latitude' => 31.217288, 'longitude' => 130.768172];
        $param[218] = ['prefecture_id' => 46, 'name' => '肝付町', 'code' => '464929', 'latitude' => 31.344364, 'longitude' => 130.945223];
        $param[219] = ['prefecture_id' => 46, 'name' => '中種子町', 'code' => '465011', 'latitude' => 30.533022, 'longitude' => 130.958609];
        $param[220] = ['prefecture_id' => 46, 'name' => '南種子町', 'code' => '465020', 'latitude' => 30.414049, 'longitude' => 130.900949];
        $param[221] = ['prefecture_id' => 46, 'name' => '屋久島町', 'code' => '465054', 'latitude' => 30.316548, 'longitude' => 130.65556];
        $param[222] = ['prefecture_id' => 46, 'name' => '大和村', 'code' => '465232', 'latitude' => 28.358018, 'longitude' => 129.395231];
        $param[223] = ['prefecture_id' => 46, 'name' => '宇検村', 'code' => '465241', 'latitude' => 28.28072, 'longitude' => 129.297287];
        $param[224] = ['prefecture_id' => 46, 'name' => '瀬戸内町', 'code' => '465259', 'latitude' => 28.146357, 'longitude' => 129.314871];
        $param[225] = ['prefecture_id' => 46, 'name' => '龍郷町', 'code' => '465275', 'latitude' => 28.413303, 'longitude' => 129.589354];
        $param[226] = ['prefecture_id' => 46, 'name' => '喜界町', 'code' => '465291', 'latitude' => 28.317055, 'longitude' => 129.940065];
        $param[227] = ['prefecture_id' => 46, 'name' => '徳之島町', 'code' => '465305', 'latitude' => 27.726599, 'longitude' => 129.01868];
        $param[228] = ['prefecture_id' => 46, 'name' => '天城町', 'code' => '465313', 'latitude' => 27.811796, 'longitude' => 128.897727];
        $param[229] = ['prefecture_id' => 46, 'name' => '伊仙町', 'code' => '465321', 'latitude' => 27.67354, 'longitude' => 128.937854];
        $param[230] = ['prefecture_id' => 46, 'name' => '和泊町', 'code' => '465330', 'latitude' => 27.392076, 'longitude' => 128.655441];
        $param[231] = ['prefecture_id' => 46, 'name' => '知名町', 'code' => '465348', 'latitude' => 27.333633, 'longitude' => 128.57381];
        $param[232] = ['prefecture_id' => 46, 'name' => '与論町', 'code' => '465356', 'latitude' => 27.048511, 'longitude' => 128.414871];

        DB::table('municipalities')->insert($param);
    }
}
