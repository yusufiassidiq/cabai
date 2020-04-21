<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['jenis_cabai','jumlah_cabai','tanggal_diterima','tanggal_pengiriman','harga','keterangan','pembeli_id'];
    protected $table = 'transaksi';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
