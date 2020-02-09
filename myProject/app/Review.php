<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded =array('id');

    public function genres()
    {
        return $this->hasMany('\App\Genre', 'id', 'genre');
    }
}
