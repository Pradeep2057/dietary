<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Producttype;

class ProducttypePolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Producttype $producttype)
    {
        return $user->id == $producttype->author_id || $user->role == '0';
    }

    public function delete(User $user, Producttype $producttype)
    {
        return $user->role == '0';
    }
}
