<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Renew;

class RenewPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Renew $renew)
    {
        if ($user->role == '0' || $user->role == '1') {
            return true;
        }
    
        if ($user->role == '2' && $renew->status == 'Processing') {
            return true;
        }
        return false;
    }

    public function delete(User $user, Renew $renew)
    {
        return $user->role == '0';
    }
}
