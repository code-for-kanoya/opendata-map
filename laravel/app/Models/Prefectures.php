<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prefectures extends Model
{
    //モデルと関連しているテーブル
    protected $table = 'prefectures';

    //primarykeyの変更
    protected $primarykey = 'region_id';

    //belongsTo設定
    public function region()
    {
        return $this->belongsTo('App\Models\Regions');
    }
}
