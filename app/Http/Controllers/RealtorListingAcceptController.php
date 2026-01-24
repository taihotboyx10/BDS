<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Notifications\OfferAccepted;
use Illuminate\Support\Facades\DB;

class RealtorListingAcceptController extends Controller
{
    public function acceptOffer(Offer $offer)
    {
        // dd($offer);
        DB::transaction(function () use ($offer) {
            $offer->update([
                'acceped_at' => now(),
            ]);

            Offer::getOtherOffer($offer->id, $offer->listing_id)
                ->update([
                    'rejected_at' => now(),
                ]);

            $offer->listing->update([
                'is_solded' => true,
            ]);

            // send mail to bidder
            $offer->user->notify(new OfferAccepted($offer));
        });

        return redirect()->back()->with('success', 'Accepted the offer!');
    }
}
