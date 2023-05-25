<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Registration;

class RegistrationPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Registration $registration)
    {
        if ($user->role == '0' || $user->role == '1') {
            return true;
        }
    
        if ($user->role == '2' && $registration->status == 'Processing') {
            return true;
        }
        return false;
    }

    public function delete(User $user, Registration $registration)
    {
        return $user->role == '0';
    }
}
