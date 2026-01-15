<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Offer;
use App\Notifications\OfferMade;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ListingOfferController extends Controller
{
    use AuthorizesRequests;
    
    public function store(Listing $listing, Request $request)
    {
        $this->authorize('create', [Offer::class, $listing]);
        
        $data = $request->validate([
            'amount' => 'required|integer'
        ]);

        $offer = Auth::user()->offers()->create([
            'listing_id' => $listing->id,
            'amount' => $data['amount'],
        ]);
        $listing->user->notify(new OfferMade($offer));

        return redirect()->back()->with('success', 'Make offer done!');
    }
}
