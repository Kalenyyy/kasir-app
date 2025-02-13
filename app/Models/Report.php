<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_customer',
        'products_id',
        'tanggal_penjualan',
        'total_barang',
        'total_harga',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }
}
