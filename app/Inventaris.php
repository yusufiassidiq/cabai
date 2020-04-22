<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    protected $fillable = ['jenis_cabai','jumlah_cabai','harga'];
    protected $table = 'inventaris';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
