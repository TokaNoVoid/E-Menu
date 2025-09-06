<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Str;

class ProductCategory extends Model
{

    use SoftDeletes;
    
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'icon'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (Auth::user()->role === 'store') {
                $category->user_id = Auth::user()->id;
            }

            $category->slug = Str::slug($category->name);
        });

        static::updating(function ($category) {
            $category->slug = Str::slug($category->name);
        });
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}