<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['jenis_cabai','jumlah_cabai','tanggal_diterima','status_permintaan','status_pengiriman','status_pemesanan','tanggal_pengiriman','harga','keterangan','pemasok_id'];
    protected $table = 'transaksi';

    public function user(){
        return $this->belongsTo('App\User');
    }
}
