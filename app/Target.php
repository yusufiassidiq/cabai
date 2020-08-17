<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Target extends Model
{
    protected $table = 'targets';
    protected $fillable = ['bulan','tahun','jenis_cabai','jumlah_cabai'];

    public function target()
    {
        return $this->belongsTo('App\User');
    }
}
