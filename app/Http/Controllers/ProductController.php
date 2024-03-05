<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        return view('product.index', [ 'products' => Product::all() ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(StoreProductRequest $request)
    public function store(Request $request)
    {
        Product::create($request->all());

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', [ 'product' => $product ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('product.edit', [ 'product' => $product ]);
    }

    /**
     * Update the specified resource in storage.
     */
    //public function update(UpdateProductRequest $request, Product $product)
    public function update(Request $request, Product $product)
    {
        $product->name = $request->name;
        $product->save();

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
