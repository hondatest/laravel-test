<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Product;

class ReviewController extends Controller
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
        $this->authorizeResource(Review::class, 'review');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Show the form for creating a new resource.
     *
     * @access public
     * @return Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('review.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @access public
     * @param StoreReviewRequest $request
     * @return RedirectResponse
     */
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        Auth::user()->reviews()->attach($request->product_id, [ 'text' => $request->text ]);
        
        return redirect()->route('products.show', [ 'product' => $request->product_id ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
