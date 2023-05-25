<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    public function create(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function display(User $user)
    {
        return $user->role == '0' || $user->role == '1' || $user->role == '2';
    }

    public function update(User $user, Product $product)
    {
        if ($user->role == '0' || $user->role == '1' ) {
            return true;
        }
    
        if ($user->role == '2' && $product->status == 'Pending') {
            return true;
        }
    
        return false;
    }

    public function delete(User $user, Product $product)
    {
        return $user->role == '0';
    }
}
