<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Capital;

class CapitalPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Capital $capital)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function delete(User $user, Capital $capital)
    {
        return $user->role == '0';
    }
}
