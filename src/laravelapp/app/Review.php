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
    public function users()
    {
        return $this->belongsToMany('\App\User', 'review_userLikes', 'review_id', 'user_id');
    }
    public function review_tags()
    {
        return $this->hasMany('\App\ReviewTag');
    }
    public function review_niy_replies()
    {
        return $this->hasMany('\App\ReviewNiyReply');
    }
}
