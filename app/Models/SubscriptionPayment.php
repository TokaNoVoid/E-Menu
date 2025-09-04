<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'subscription_id',
        'proof',
        'status'
    ];

    public function subcription()
    {
        return $this->belongsTo(Subscription::class);
    }
}