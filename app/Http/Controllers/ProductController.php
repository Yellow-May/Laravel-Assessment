<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelpers;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function create(StoreProductRequest $request)
    {
        $body_data = $request->validated();

        // Save image
        $body_data['image'] = $request->file('image')->store('products-images', 'public');
        $new_product = Product::create($body_data);

        return AppHelpers::api_response($new_product, 201, "Product created successfully");
    }

    public function all()
    {
        $page = request('page') ?? 1;
        $per_page = request('per_page') ?? 10;
        $category = request('category');
        $q = request('q');

        $products = Product::latest();

        // handle category filter
        if (request()->has('category')) {
            $products = $products->where('category_id', $category);
        }

        // handle search filter
        if (request()->has('q')) {
            $products = $products->where('name', 'LIKE', "%$q%");
        }

        // paginate
        $products = $products->paginate($per_page, [
            'id', 'name', 'quantity', 'price', 'image', 'description', 'created_at', 'category_id'
        ], 'page', $page);

        // transform image url by appending app url
        $products->transform(function ($product) {
            $product->image = config('app.url') . Storage::url($product->image);
            return $product;
        });

        return AppHelpers::api_response($products);
    }

    public function single($id)
    {
        $product = Product::find($id, [
            'id', 'name', 'quantity', 'price', 'image', 'description', 'created_at', 'category_id'
        ]);

        // Return error if product doesn't exists
        if (!$product) {
            return AppHelpers::api_response(null, 404, "Product not found");
        }

        // transform image url by appending app url
        $product->image = config('app.url') . Storage::url($product->image);

        return AppHelpers::api_response($product);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        // Check if product exists
        $product = Product::find($id);
        if (!$product) {
            return AppHelpers::api_response(null, 404, "Product not found");
        }

        // Check if request has been validated
        $body_data = $request->validated();

        // Check if request has image
        if ($request->hasFile("image")) {
            // Remove old image
            Storage::disk('public')->delete($product->image ?? '');
            // Save new image
            $body_data['image'] = $request->file('image')->store('products-images', 'public');
        }

        $product->update($body_data);

        return AppHelpers::api_response($body_data, 200, "Product updated successfully");
    }

    public function delete($id)
    {
        // Check if product exists
        $product = Product::find($id);
        if (!$product) {
            return AppHelpers::api_response(null, 404, "Product not found");
        }

        // Remove image
        Storage::disk('public')->delete($product->image ?? '');

        // Delete product
        $product->delete();


        return AppHelpers::api_response(null, 200, "Product deleted successfully");
    }
}
