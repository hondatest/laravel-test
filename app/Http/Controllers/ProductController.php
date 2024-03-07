<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

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
        Product::create([
          'name' => $request->name,
          'user_id' => Auth::id()
        ]);

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
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $product->name = $request->name;
        $product->save();

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
