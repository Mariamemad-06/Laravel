<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{

    /*
    * Create list api for products
    * Method name: index
    * URL: /api/products
    * Method: GET
    * Search about pagination in laravel
    */
    public function index (Request $request)
    {
        $products = Product::paginate(10);
        return $products;
    }
    //STORE
    public function store(ProductRequest $request)
    {
         $product = Product::create($request->validated());

         return new ProductResource($product);
    }
    //UPDATE
    public function update(ProductRequest $request, $id)
    {
        $product=Product::findOrFail($id);

       $product->update($request->validated());

       return new ProductResource($product);
    }
    //DELETE
    public function delete(Product $product)
    {
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
    //SHOW
    public function show(Product $product)
    {
        return new ProductResource($product);
    }
}
