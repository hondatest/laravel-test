<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
  public function index () {
    return view('test.index', [
      //'values' => [1, 2, 3, 4]
      'values' => []
    ]);
  }
}
