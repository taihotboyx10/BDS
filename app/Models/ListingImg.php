<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingImg extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'listing_id',
    ];
    protected $appends = ['image_url'];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function getImageUrlAttribute()
    {
        return asset('storage/ListingImages/' . $this->file_name);
    }
}
