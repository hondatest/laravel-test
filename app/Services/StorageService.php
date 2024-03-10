<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class StorageService
{
    // @const product directory
    public const PRODUCT_DIRECTORY = 'images/product';

    /**
     * ファイルをストレージに保存する
     * 
     * @access public
     * @param  string $directory
     * @param  array<\Illuminate\Http\UploadedFile> $uploaded_files
     * @return array 保存済みファイル名配列
     */
    public static function putFiles(string $directory, array $uploaded_files): array
    {
        $file_names = [];

        foreach ($uploaded_files as $uploaded_file) {
            $file_path = Storage::putFile($directory, $uploaded_file);
            $file_names[] = basename($file_path);
        }

        return $file_names;
    }

    /**
     * ストレージから複数のファイルを削除する
     * 
     * @access public
     * @param  string $directory
     * @param  array $file_names
     * @return void
     */
    public static function deleteFiles(string $directory, array $file_names): void
    {
        foreach ($file_names as $file_name) {
            Storage::delete($directory . '/' . $file_name);
        }
    }

    /**
     * ストレージからファイルを削除する
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
