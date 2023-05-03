<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Country;

class CountryPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Country $country)
    {
        return $user->id == $country->author_id || $user->role == '0';
    }

    public function delete(User $user, Country $country)
    {
        return $user->role == '0';
    }
}
