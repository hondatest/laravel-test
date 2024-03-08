<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class StorageService
{
    // @const product directory
    public const PRODUCT_DIRECTORY = 'images/product';

    /**
     * ファイルを保存する
     * 
     * @access public
     * @param  \Illuminate\Http\UploadedFile $uploaded_file
     * @return string 保存したファイル名
     */
    public static function putFile(string $directory, UploadedFile $uploaded_file): string
    {
        $file_path = Storage::putFile($directory, $uploaded_file);

        return basename($file_path);
    }

    /**
     * ファイルを削除する
     * 
     * @access public
     * @param  string $directory
     * @param  string $file_name
     * @return void
     */
    public static function deleteFile(string $directory, string $file_name): void
    {
        Storage::delete($directory . '/' . $file_name);
    }
}
