<?php

namespace App\Http\Controllers\API\v1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{

    public function index() : JsonResponse
    {
        $products = ProductResource::collection(Product::all());
        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function store(Request $request) : JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $meta = [];

        $meta['image'] = $request->input('image');
        $product = Product::create(array_merge($validator->validated(), [
            'metadata' => $meta,
            'category' => $request->input('category'),
            'uuid' => Str::uuid(),
        ]));

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function show($uuid) {
        $product = new ProductResource(Product::where('uuid', $uuid)->first());

        return response()->json([
            'success' => true,
            'data' => $product
        ]);
    }

    public function update($uuid){}

    public function destroy($uuid){}
}
