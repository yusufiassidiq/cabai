<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    protected $fillable = ['jumlah_panen','pra_produksi_id','tanggal_panen'];
    protected $table = 'panen';

    public function praProduksi(){
        return $this->belongsTo('App\PraProduksi');
    }
}
