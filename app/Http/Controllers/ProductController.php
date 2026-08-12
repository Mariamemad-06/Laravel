<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $product = $request->all();

        return Product::create($product);
    }
    public function update(Request $request, $id)
    {
        $product=Product::findOrFail($id);

        $request->validate([
            'name' =>'required|string|max:255',
            'description' =>'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);
        $product->update($request->all());
       return response()->json([
        'message' => 'Product updated successfully',
        'product' => $product
       ]);
    }
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        $product = Product::findOrFail($request->id);
        $product->delete();

        return response()->json([
            'message' => 'Product deleted successfully',
        ]);
    }
}
