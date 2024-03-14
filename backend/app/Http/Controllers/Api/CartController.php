<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCartRequest;
use App\Http\Resources\CartResource;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display the user's cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\CartResource
     */
    public function index(Request $request): CartResource {
        $user = $request->user()->load('cart.courses');

        return new CartResource($user->cart);
    }
    /**
     * Add a course to the user's cart.
     *
     * @param  \App\Http\Requests\Api\StoreCartRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCartRequest $request): \Illuminate\Http\JsonResponse {
        $user = auth()->user();
        $data = $request->validated();

        $cart = $user->cart()->firstOrCreate();

        $cart->courses()->attach($data);

        return response()->json(['message' => 'Course added to cart successfully'], 200);
    }


    /**
     * Remove a course from the user's cart.
     *
     * @param  int  $course_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $course_id): \Illuminate\Http\JsonResponse {
        $user = auth()->user();

        $user->load('cart.courses');

        $user->cart->courses()->detach($course_id);

        return response()->json(['message' => 'Course removed from cart successfully'], 200);
    }
}
