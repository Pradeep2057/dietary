<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Nutrients;

class NutrientsPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Nutrients $nutrients)
    {
        return $user->id == $nutrients->author_id || $user->role == '0';
    }

    public function delete(User $user, Nutrients $nutrients)
    {
        return $user->role == '0';
    }
}
