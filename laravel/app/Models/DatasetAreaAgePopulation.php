<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatasetAreaAgePopulation extends Model
{
    /**
     * 複数代入しない属性
     *
     * @var array
     */
    protected $guarded = ['id'];

    //モデルと関連しているテーブル
    protected $table = 'dataset_area_age_population';
}
