<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Renewal;

class RenewalPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Renewal $renewal)
    {
        if ($user->role == '0' || $user->role == '1') {
            return true;
        }
    
        if ($user->role == '2' && $renewal->status == 'Processing') {
            return true;
        }
        return false;
    }

    public function delete(User $user, Renewal $renewal)
    {
        return $user->role == '0';
    }
}
