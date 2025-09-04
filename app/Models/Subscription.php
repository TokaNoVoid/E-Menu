<?php

namespace App\Models;

use Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'end_date',
        'is_active'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($subscription) {
            $subscription->user_id = Auth::user()->id;
            $subscription->end_date = now()->addDays(30);


        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptionPayment(){
        return $this->hasOne(SubscriptionPayment::class);
    }
}