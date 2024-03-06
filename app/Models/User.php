<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * ユーザテーブルとクチコミテーブルを関連付ける
     *
     * @access public
     * @return BelongsToMany
     */
    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'reviews')
            ->withTimestamps();
    }

    /**
     * ユーザがクチコミを投稿済みか判定する
     *
     * @access public
     * @param integer $product_id
     * @return boolean
     */
    public function hasPostedReview(int $product_id)
    {
        return $this->reviews()->find($product_id) ? true:false;
    }
}
