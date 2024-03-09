<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * 商品テーブルと商品画像テーブルを関連付ける
     *
     * @access public
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * 同じユーザIDか判定する
     *
     * @access public
     * @param  int $user_id
     * @return bool
     */
    public function isSameUserId(int $user_id): bool
    {
        return $this->user_id === $user_id;
    }

    /**
     * 商品画像情報を商品画像テーブルに保存する
     *
     * @access public
     * @param  array $file_names
     * @return void
     */
    public function saveProductImages(array $file_names): void
    {
        $name_columns = [];

        foreach ($file_names as $file_name) {
            $name_columns[] = ['name' => $file_name];
        }

        $this->productImages()->createMany($name_columns);
    }
}
