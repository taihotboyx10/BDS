<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Listing;
use Illuminate\Support\Facades\Auth;

class ListingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // use authorization policy in each controller method
        $this->authorize('viewAny', Listing::class);

        $filters = $request->only(['price_from', 'price_to', 'beds', 'baths', 'area_from', 'area_to']);

        $listings = Listing::filter($filters)->mostRecent()->paginate(5)->withQueryString();

        return Inertia('Listings/Index', [
            'filters' => $filters,
            'listings' => $listings,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $this->authorize('view', $listing);
        $listing->load('listingImgs');
        $offer = $listing->offers()->getOffer(Auth::user()?->id)->first();

        return Inertia('Listings/Show', [
            'listing' => $listing,
            'offer' => $offer,
        ]);
    }
}
