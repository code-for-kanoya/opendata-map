<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Regions extends Model
{
    //モデルと関連しているテーブル
    protected $table = 'regions';

    //hasMany設定
    public function prefectures()
    {
        return $this->hasMany('App\Models\Prefectures');
    }
}
