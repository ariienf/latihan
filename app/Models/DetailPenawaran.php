<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPenawaran extends Model
{
    use HasFactory;

    protected $fillable = ['jumlah', 'subtotal', 'penawaran_id', 'produk_id'];

    public function penawaran()
    {
        return $this->belongsTo(Penawaran::class);
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
