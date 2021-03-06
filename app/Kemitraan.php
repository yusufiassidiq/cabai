<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kemitraan extends Model
{
    protected $fillable = ['status','action_user','user1_id','user2_id'];
    protected $table = 'kemitraan';

    public function user1(){
        return $this->belongsTo('App\User');
    }
    public function user2(){
        return $this->belongsTo('App\User');
    }
}
