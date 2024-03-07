<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProductPolicy
{
    /**
     * Determine whether the user can view any models.
     * 
     * @access public
     * @param  \App\Models\User $user
     * @return bool
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     * 
     * @access public
     * @param  \App\Models\User $user
     * @param  \App\Models\Product $product
     * @return bool
     */
    public function view(?User $user, Product $product): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     * 
     * @access public
     * @param  \App\Models\User $user
     * @return bool
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     * 
     * @access public
     * @param  \App\Models\User $user
     * @param  \App\Models\Product $product
     * @return bool
     */
    public function update(User $user, Product $product): bool
    {
        return $product->isSameUserId($user->id);
    }

    /**
     * Determine whether the user can delete the model.
     * 
     * @access public
     * @param  \App\Models\User $user
     * @param  \App\Models\Product $product
     * @return bool
     */
    public function delete(User $user, Product $product): bool
    {
        return $product->isSameUserId($user->id);
    }
}
