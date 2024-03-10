<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Services\StorageService;

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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
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

    /**
     * 商品画像テーブルから商品画像IDと一致するレコードを削除する
     *
     * @access public
     * @param  array<\Illuminate\Http\UploadedFile> $uploaded_files
     * @return void
     */
    public function deleteProductImages(array $uploaded_files): void
    {
        $product_images_id_to_delete = [];

        foreach (array_keys($uploaded_files) as $key) {
            $product_images_id_to_delete[] = $this->productImages[$key]->id;
        }

        $this->productImages()->whereIn('id', $product_images_id_to_delete)->delete();
    }

    /**
     * ストレージから商品画像ファイルを削除する
     *
     * @access public
     * @param array<\Illuminate\Http\UploadedFile> $uploaded_files
     * @return void
     */
    public function deleteProductImagesInStorage(array $uploaded_files): void
    {
        foreach (array_keys($uploaded_files) as $key) {
            StorageService::deleteFile(StorageService::PRODUCT_DIRECTORY, $this->productImages[$key]->name);
        }
    }

    /**
     * ストレージから全ての商品画像ファイルを削除する
     *
     * @access public
     * @return void
     */
    public function deleteAllProductImagesInStorage(): void
    {
        $file_names_to_delete = $this->productImages->pluck('name');
        StorageService::deleteFiles(StorageService::PRODUCT_DIRECTORY, $file_names_to_delete->toArray());
    }
}
