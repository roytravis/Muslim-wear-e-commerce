<?php
// File: app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'name',
        'description',
        'price',
        'stock',
    ];

    // RELASI: Satu Product dimiliki oleh satu Store
    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    // RELASI: Satu Product memiliki banyak ProductImage
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}