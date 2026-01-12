<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = ['user_is', 'listing_id', 'amount', 'acceped_at', 'rejected_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listing(): BelongsTo
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function scopeGetOffer(Builder $query, $userId) 
    {
        return $query->where('user_id', $userId);
    }

    public function scopeGetOtherOffer(Builder $query, $mainOfferId, $listingId)
    {
        return $query->where('listing_id', $listingId)
                     ->where('id', '!=', $mainOfferId);
    }
}
