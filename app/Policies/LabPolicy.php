<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lab;

class LabPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Lab $lab)
    {
        return $user->id == $lab->author_id || $user->role == '0';
    }

    public function delete(User $user, Lab $lab)
    {
        return $user->role == '0';
    }
}
