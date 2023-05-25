<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Size;

class SizePolicy
{
    public function create(User $user)
    {
        $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Size $size)
    {
        $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function delete(User $user, Size $size)
    {
        return $user->role == '0';
    }
}
