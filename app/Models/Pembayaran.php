<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    public function keranjang()
    {
        return $this->belongsTo('App\Models\Keranjang', 'id_keranjangs', 'id');
    }

    public function barang()
    {
        return $this->belongsTo('App\Models\Barang', 'id_barangs', 'id');
    }
}
