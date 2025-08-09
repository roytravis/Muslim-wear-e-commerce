<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'logo',
    ];

    // RELASI: Satu Store dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // RELASI: Satu Store memiliki banyak Product
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}