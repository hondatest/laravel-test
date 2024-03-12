<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Models\Review;

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
     * 
     * @access public
     * @return \Illuminate\View\View
     */
    public function index(): View
    {
        return view('review.index', ['products' => auth()->user()->reviews]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @access public
     * @return \Illuminate\View\View
     */
    public function create(): View
    {
        return view('review.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @access public
     * @param  \App\Http\Requests\StoreReviewRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreReviewRequest $request): RedirectResponse
    {
        auth()->user()->reviews()->attach($request->product_id, ['text' => $request->text]);

        return redirect()->route('products.show', ['product' => $request->product_id]);
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
     * 
     * @access public
     * @param  \App\Models\Review $review
     * @return \Illuminate\View\View
     */
    public function edit(Review $review): View
    {
        return view('review.edit', ['product' => auth()->user()->reviews()->find($review->product_id)]);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @access public
     * @param  \App\Http\Requests\UpdateReviewRequest $request
     * @param  \App\Models\Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateReviewRequest $request, Review $review): RedirectResponse
    {
        auth()->user()->reviews()->updateExistingPivot($review->product_id, ['text' => $request->text]);

        return redirect()->route('reviews.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @access public
     * @param  \App\Models\Review $review
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Review $review): RedirectResponse
    {
        auth()->user()->reviews()->detach($review->product_id);

        return redirect()->route('reviews.index');
    }
}
