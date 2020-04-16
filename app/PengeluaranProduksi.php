<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PengeluaranProduksi extends Model
{
    protected $fillable = ['nama_pengeluaran','jumlah_pengeluaran','rincian'];
    protected $table = 'pengeluaran_produksi';

    public function praProduksi()
    {
        return $this->belongsTo('App\PraProduksi');
    }
}
