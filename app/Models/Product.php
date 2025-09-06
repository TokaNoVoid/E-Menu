<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "user_id",
        "product_category_id",
        "image",
        "name",
        "description",
        "price",
        'rating',
        'is_popular'
    ];

    protected $casts = [
        "price"=> "decimal:2",
    ];


    public static function boot()
    {
        parent::boot();

        // Saat create
        static::creating(function ($product) {
            // kalau belum login, jangan apa-apa
            if (!Auth::check()) {
                return;
            }

            // kalau bukan admin, otomatis set user_id
            if (Auth::user()->role !== 'admin') {
                $product->user_id = Auth::id();
            }
            // kalau admin, biarkan saja field user_id dari form kalau ada
        });

        // Saat update
        static::updating(function ($product) {
            // kalau tidak login, jangan diapa-apain
            if (!Auth::check()) {
                return;
            }

            // hanya update user_id kalau bukan admin
            if (Auth::user()->role !== 'admin') {
                $product->user_id = Auth::id();
            }
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function productIngredients(){
        return $this->hasMany(ProductIngredient::class);
    }

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function transactionDetails(){
        return $this->hasMany(TransactionDetail::class);
    }
}