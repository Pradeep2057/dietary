<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Expirydate;

class ExpirydatePolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Expirydate $expirydate)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function delete(User $user, Expirydate $expirydate)
    {
        return $user->role == '0';
    }
}
