<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['from','to','text'];
    protected $table = 'messages';

    public function fromContact()
    {   
        return $this->hasOne(User::class, 'id', 'from');
    }
}
