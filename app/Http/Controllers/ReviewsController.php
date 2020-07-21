<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;

class ReviewsController extends Controller
{
    public function list(Request $request)
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    public function show(Request $request)
    {

    }

    public function create(Request $request)
    {

    }
}
