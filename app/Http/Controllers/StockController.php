<?php

namespace App\Http\Controllers;
use App\Http\Requests\StockRequest;
use App\Http\Resources\StockResource;
use App\Models\Stock;

use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StockResource::collection(
            Stock::paginate(10)
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StockRequest $request)
    {
        $stock = Stock::create($request->validated());

        return new StockResource($stock);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stock $stock)
    {

        return new StockResource($stock);
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(StockRequest $request, Stock $stock)
    {
        $stock->update($request->validated());

        return new StockResource($stock);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stock $stock)
    {
        $stock->delete();
        return response()->json([
            'message' => 'Stock deleted successfully',
        ]);

    }
}
