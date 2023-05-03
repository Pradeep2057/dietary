<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Productform;

class ProductformPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Productform $productform)
    {
        return $user->id == $productform->author_id || $user->role == '0';
    }

    public function delete(User $user, Productform $productform)
    {
        return $user->role == '0';
    }
}
