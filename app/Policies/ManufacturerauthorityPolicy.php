<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Manufacturerauthority;

class ManufacturerauthorityPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Manufacturerauthority $manufacturerauthority)
    {
        return $user->id == $manufacturerauthority->author_id || $user->role == '0';
    }

    public function delete(User $user, Manufacturerauthority $manufacturerauthority)
    {
        return $user->role == '0';
    }
}
