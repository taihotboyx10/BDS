<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Listing extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'beds',
        'baths',
        'area',
        'city',
        'code',
        'street',
        'street_nr',
        'price',
        'is_solded',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function listingImgs()
    {
        return $this->hasMany(ListingImg::class, 'listing_id');
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function scopeMostRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // filter in listings section
    public function scopeFilter($query, $filters)
    {
        // loại bỏ những model offer mà acceped_at không null
        $query->whereDoesntHave('offers', function ($q) {
            $q->whereNotNull('acceped_at');
        });

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

    // filter in realtor listing section
    public function scopeRealtorFilter($query, $filters)
    {
        if (isset($filters['deleted']) && $filters['deleted'] === 'true') {
            $query->withTrashed();
        }

        if (isset($filters['solded']) && $filters['solded'] === 'false') {
            $query->where('is_solded', false);
        }

        if (isset($filters['sortBy'])) {
            $sortStyle = $filters['sortStyle'] ?? 'desc';
            if ($filters['sortBy'] === 'price') {
                $query->orderBy('price', $sortStyle);
            }

            if ($filters['sortBy'] === 'created_at') {
                $query->orderBy('created_at', $sortStyle);
            }
        }

        return $query;
    }

    public function checkIsHasOffer(): bool
    {
        return $this->offers()->whereNull('acceped_at')->exists();
    }
}
