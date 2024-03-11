<?php

namespace App\Collections;

use App\Services\StorageService;

class ProductImages
{
    /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\ProductImage> $products */
    private $product_images;

    /**
     * コンストラクタ
     *
     * @access public
     * @param  \Illuminate\Database\Eloquent\Collection<\App\Models\ProductImage> $product_images
     * @return void
     */
    public function __construct($product_images)
    {
        $this->product_images = $product_images;
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
            $this->product_images[$key]->deleteProductImagesInStorage();
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
        $file_names_to_delete = $this->product_images->pluck('name');
        StorageService::deleteFiles(StorageService::PRODUCT_DIRECTORY, $file_names_to_delete->toArray());
    }
}
