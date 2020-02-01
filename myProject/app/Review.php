<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded =array('id');

    public static $rules = array(
        'user_name' => 'required',
        'genre' => 'required',
        'title' => 'required',
        'chysh' => 'required',
        'hyk' => 'required',
        'review_niy' => 'required'
    );
}
