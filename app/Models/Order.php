<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_customer',
        'products_id',
        'members_id',
        'users_id',
        'tanggal_penjualan',
        'total_barang',
        'total_harga',
        'customer_pay',
        'customer_return',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'products_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function members(){
        return $this->belongsTo(Member::class, 'members_id', 'id');
    }
}
