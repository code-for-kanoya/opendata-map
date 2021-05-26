<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipalities extends Model
{
    //モデルと関連しているテーブル
    protected $table = 'municipalities';

    //primarykeyの変更
    protected $primarykey = 'prefecture_id';

    //belongsTo設定
    public function prefecture()
    {
        return $this->belongsTo('App\Models\Prefectures');
    }
}
