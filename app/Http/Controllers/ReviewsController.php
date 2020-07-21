<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class ReviewsController extends Controller
{
    const PER_PAGE = 10;
    public function list(Request $request)
    {
        try {
            $data = $this->validate($request, [
                'orderField' => Rule::in(['rating', 'created_at']),
                'orderDirection' => Rule::in(['asc', 'desc']),
                'page' => 'integer',
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->getMessage(), $e->status);
        }

        $sortBy = $data['orderField'] ?? 'created_at';
        $sortDirection = $data['orderDirection'] ?? 'desc';
        $page = $data['page'] ?? 1;
        $offset = self::PER_PAGE * ($page - 1);

        $reviews = Review::query()
            ->orderBy($sortBy, $sortDirection)
            ->skip($offset)
            ->limit(self::PER_PAGE)
            ->select(['id', 'author', 'rating', 'links'])
            ->get();

        return response()->json($reviews);
    }

    public function show(int $id, Request $request)
    {
        try {
            $data = $this->validate($request, [
                'fields' => 'array',
                'fields.*' => Rule::in(['description', 'point_id']),
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->getMessage(), $e->status);
        }

        $selected = ['author', 'rating', 'links'];
        if (!empty($data['fields'])) {
            $selected = array_merge($selected, $data['fields']);
        }

        $review = Review::query()
            ->select($selected)
            ->find($id);
        if (!$review) {
            return response()->json('Review not found', 404);
        }

        return response()->json($review, 200);
    }

    public function create(Request $request)
    {
        try {
            $data = $this->validate($request, [
                'author' => 'required|string|max:50',
                'description' => 'required|string|max:1000',
                'links' => 'array|max:3',
                'rating' => 'required|integer|min:1|max:5',
            ]);
        } catch (ValidationException $e) {
            return response()->json($e->getMessage(), $e->status);
        }

        if (isset($data['links'])) {
            $data['links'] = json_encode($data['links']);
        }

        try {
            $review = new Review($data);
            $review->save();
            return response()->json($review->id, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
