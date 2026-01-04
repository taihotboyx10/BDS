<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Models\ListingImg;

class ListingImgController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Listing $listing)
    {
        // load listing with its images
        $listing->load('listingImgs');

        return Inertia('Realtor/ListingImg/Create', [
            'listing' => $listing,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Listing $listing)
    {
        $request->validate([
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ],
        [
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Each image must be a file of type: jpeg, png, jpg, gif, svg.',
            'images.*.max' => 'Each image must not exceed 4MB in size.',
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $fileName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('ListingImages', $fileName, 'public');
                
                $listing->listingImgs()->create([
                    'file_name' => $fileName,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Images uploaded successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Listing $listing, ListingImg $img)
    {
        // delete image file from storage
        $imagePath = public_path('storage/ListingImages/' . $img->file_name);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }

        // delete record from database
        $img->delete();

        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
}
