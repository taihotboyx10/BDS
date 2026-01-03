<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Listing;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RealtorListingController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', Listing::class);
        // dd($request->all());
        $filters = $request->only(['deleted', 'sortBy', 'sortStyle']);

        $listings = Auth::user()->listings()->realtorFilter($filters)->mostRecent()->paginate(5)->withqueryString();

        return inertia('Realtor/Index', [
            'filterParams' => $filters,
            'listings' => $listings,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        $this->authorize('view', $listing);

        return Inertia('Realtor/Show', [
            'listing' => $listing,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia('Realtor/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $listing = $request->validate([
            'beds' => 'required|integer|min:0|max:5',
            'baths' => 'required|integer|min:0|max:5',
            'area' => 'required|integer|min:20|max:500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|integer|min:0|max:9999',
            'price' => 'required|integer|min:1000|max:1000000',
        ]);

        $request->user()->listings()->create($listing);

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return Inertia('Realtor/Edit', [
            'listing' => $listing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
        $this->authorize('update', $listing);

        $listing->update($request->validate([
            'beds' => 'required|integer|min:0|max:5',
            'baths' => 'required|integer|min:0|max:5',
            'area' => 'required|integer|min:20|max:500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|integer|min:0|max:9999',
            'price' => 'required|integer|min:1000|max:1000000',
        ]));

        return redirect()->route('realtor.listing.index')
            ->with('success', 'Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $this->authorize('delete', $listing);

        $listing->deleteOrFail();

        return back()->with('success', 'Listing deleted successfully.');
    }

    public function restore(Listing $listing)
    {
        $this->authorize('restore', $listing);

        $listing->restore();

        return back()->with('success', 'Listing restored successfully.');
    }
}
