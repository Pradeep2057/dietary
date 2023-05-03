<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Size;

class SizePolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Size $size)
    {
        return $user->id == $size->author_id || $user->role == '0';
    }

    public function delete(User $user, Size $size)
    {
        return $user->role == '0';
    }
}
