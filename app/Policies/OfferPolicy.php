<?php

namespace App\Policies;

use App\Models\Listing;
use App\Models\User;

class OfferPolicy
{

    public function create(?User $user, Listing $listing)
    {
        return $user->id !== $listing->user_id;
    }
}
