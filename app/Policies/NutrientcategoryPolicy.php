<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Nutrientcategory;

class NutrientcategoryPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Nutrientcategory $nutrientcategory)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function delete(User $user, Nutrientcategory $uutrientcategory)
    {
        return $user->role == '0';
    }
}
