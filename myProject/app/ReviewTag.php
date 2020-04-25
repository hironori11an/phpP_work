<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewTag extends Model
{
    protected $primaryKey = 'id';
    protected $guarded =array('id');

    // リレーション
    public function review()
    {
        return $this->belongsTo('App\Review');
    }
}
