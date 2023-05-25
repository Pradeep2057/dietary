<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Productform;

class ProductformPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Productform $productform)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function delete(User $user, Productform $productform)
    {
        return $user->role == '0';
    }
}
