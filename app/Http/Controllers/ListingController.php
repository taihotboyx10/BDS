<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia('Listings/Index', [
            'listings' => Listing::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia('Listings/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Listing::create($request->validate([
            'beds' => 'required|integer|min:0|max:5',
            'baths' => 'required|integer|min:0|max:5',
            'area' => 'required|integer|min:20|max:500',
            'city' => 'required',
            'code' => 'required',
            'street' => 'required',
            'street_nr' => 'required|integer|min:0|max:9999',
            'price' => 'required|integer|min:1000|max:1000000',
        ]));

        return redirect()->route('listings.index')
            ->with('success', 'Listing created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Listing $listing)
    {
        return Inertia('Listings/Show', [
            'listing' => $listing,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Listing $listing)
    {
        return Inertia('Listings/Edit', [
            'listing' => $listing,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Listing $listing)
    {
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

        return redirect()->route('listings.index')
            ->with('success', 'Listing updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing)
    {
        $listing->delete();

        return redirect()->route('listings.index')
            ->with('success', 'Listing deleted successfully.');
    }
}
