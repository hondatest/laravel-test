<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{
    /**
     * Determine whether the user can view any models.
     * 
     * @access public
     * @param  \App\Models\User $user
     * @return bool
     */
    public function viewAny(User $user): bool
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
        return !$user->hasPostedReview(request()->product_id);
    }

    /**
     * Determine whether the user can update the model.
     * 
     * @access public
     * @param  \App\Models\User $user
     * @param  \App\Models\Review $review
     * @return bool
     */
    public function update(User $user, Review $review): bool
    {
        return $user->hasPostedReview($review->product_id);
    }

    /**
     * Determine whether the user can delete the model.
     * 
     * @access public
     * @param  \App\Models\User $user
     * @param  \App\Models\Review $review
     * @return bool
     */
    public function delete(User $user, Review $review): bool
    {
        return $user->hasPostedReview($review->product_id);
    }
}
