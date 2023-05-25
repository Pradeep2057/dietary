<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Fiscalyear;

class FiscalyearPolicy
{
    public function create(User $user)
    {
        return $user->role == '0';
    }

    public function update(User $user, Fiscalyear $fiscalyear)
    {
        return $user->role == '0';
    }

    public function delete(User $user, Fiscalyear $fiscalyear)
    {
        return $user->role == '0';
    }
}
