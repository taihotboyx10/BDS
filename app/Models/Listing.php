<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'beds',
        'baths',
        'area',
        'city',
        'code',
        'street',
        'street_nr',
        'price',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeFilter($query, $filters)
    {
        if (isset($filters['price_from'])) {
            $query->where('price', '>=', $filters['price_from']);
        }
        if (isset($filters['price_to'])) {
            $query->where('price', '<=', $filters['price_to']);
        }
        if (isset($filters['beds'])) {
            $query->where('beds', '=', $filters['beds']);
        }
        if (isset($filters['baths'])) {
            $query->where('baths', '=', $filters['baths']);
        }
        if (isset($filters['area_from'])) {
            $query->where('area', '>=', $filters['area_from']);
        }
        if (isset($filters['area_to'])) {
            $query->where('area', '<=', $filters['area_to']);
        }

        return $query;
    }

    public function scopeMostRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
