<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    protected $fillable = ['kabupaten','kecamatan','keluarahan'];
    protected $table = 'lokasi';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
