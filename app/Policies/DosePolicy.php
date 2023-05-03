<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Dose;

class DosePolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Dose $dose)
    {
        return $user->id == $dose->author_id || $user->role == '0';
    }

    public function delete(User $user, Dose $dose)
    {
        return $user->role == '0';
    }
}
