<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Listing;

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
}
