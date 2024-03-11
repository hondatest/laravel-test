<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\StorageService;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * ストレージから商品画像ファイルを削除する
     *
     * @access public
     * @return void
     */
    public function deleteProductImagesInStorage(): void
    {
        StorageService::deleteFile(StorageService::PRODUCT_DIRECTORY, $this->name);
    }
}
