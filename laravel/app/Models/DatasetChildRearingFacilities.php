<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatasetChildRearingFacilities extends Model
{
    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    //モデルと関連しているテーブル
    protected $table = 'dataset_child_rearing_facilities';
}
