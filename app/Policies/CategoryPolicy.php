<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Category $category)
    {
        return $user->id == $category->author_id || $user->role == '0';
    }

    public function delete(User $user, Category $category)
    {
        return $user->role == '0';
    }
}
