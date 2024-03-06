<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'name',
      'user_id'
  ];

    /**
     * 商品テーブルとクチコミテーブルを関連付ける
     *
     * @access public
     * @return BelongsToMany
     */
    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'reviews')
            ->withPivot('id', 'text')
            ->orderBy('pivot_id', 'desc')
            ->withTimestamps();
    }
}
