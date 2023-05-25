<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Ingredient;

class IngredientPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Ingredient $ingredient)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function delete(User $user, Ingredient $ingredient)
    {
        return $user->role == '0';
    }
}
