<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1';
    }

    public function update(User $user, Product $product)
    {
        return $user->id == $product->author_id || $user->role == '0';
    }

    public function delete(User $user, Product $product)
    {
        return $user->role == '0';
    }
}
