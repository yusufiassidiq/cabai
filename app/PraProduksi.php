<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PraProduksi extends Model
{
    protected $fillable = ['jenis_cabai','luas_lahan','tanggal_tanam','kode_lahan'];
    protected $table = 'pra_produksi';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
