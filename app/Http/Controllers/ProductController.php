<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Services\StorageService;

class ProductController extends Controller
{
    /**
     * 初期化
     * 
     * ポリシーで本コントローラーのメソッドの実行を制限する
     * 
     * @access public
     */
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    /**
     * Display a listing of the resource.
     * 
     * @access public
     * @return \Illuminate\View\View
     */
    public function index(): view
    {
        return view('product.index', ['products' => Product::paginate(10)]);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @access public
     * @return \Illuminate\View\View
     */
    public function create(): view
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @access public 
     * @param  \App\Http\Requests\StoreProductRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $put_file_names = [];

        try {
            DB::transaction(function () use ($request, &$put_file_names) {
                $product = Product::create([
                    'name' => $request->name,
                    'user_id' => Auth::id()
                ]);

                $put_file_names = StorageService::putFiles(StorageService::PRODUCT_DIRECTORY, $request->file('files'));
                $product->saveProductImages($put_file_names);
            });
        } catch (\Exception $e) {
            // トランザクションエラーになった場合はロールバックするので、保存済み商品画像ファイルを削除する
            StorageService::deleteFiles(StorageService::PRODUCT_DIRECTORY, $put_file_names);
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     * 
     * @access public
     * @param  \App\Models\Product $product
     * @return \Illuminate\View\View
     */
    public function show(Product $product): View
    {
        return view('product.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @access public
     * @param  \App\Models\Product $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product): View
    {
        return view('product.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @access public
     * @param  \App\Http\Requests\UpdateProductRequest $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $put_file_names = [];

        try {
            DB::transaction(function () use ($request, $product, &$put_file_names) {
                $product->fill($request->all());
                $product->save();

                // 商品画像ファイルを変更した場合は、商品画像ファイルをストレージに保存する
                $uploaded_files = $request->file('files');

                if (is_array($uploaded_files)) {
                    // トランザクションエラーを考慮して、クエリーを全て実行後に商品画像ファイルを削除する
                    $product->deleteProductImages($uploaded_files);
                    $put_file_names = StorageService::putFiles(StorageService::PRODUCT_DIRECTORY, $uploaded_files);
                    $product->saveProductImages($put_file_names);

                    // クエリーを全て実行後に商品画像ファイルを削除する
                    foreach (array_keys($uploaded_files) as $key) {
                        StorageService::deleteFile(StorageService::PRODUCT_DIRECTORY, $product->productImages[$key]->name);
                    }
                }
            });
        } catch (\Throwable $e) {
            // トランザクションエラーになった場合はロールバックするので、保存済み商品画像ファイルを削除する
            StorageService::deleteFiles(StorageService::PRODUCT_DIRECTORY, $put_file_names);
            throw $e;
        }

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     * 
     * @access public
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
