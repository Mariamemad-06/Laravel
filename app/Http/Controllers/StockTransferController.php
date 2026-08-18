<?php

namespace App\Http\Controllers;
use App\Http\Requests\StockTransferRequest;
use App\Http\Resources\StockTransferResource;
use App\Models\StockTransfer;
use Illuminate\Http\Request;

class StockTransferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return StockTransferResource::collection(
            StockTransfer::paginate(10)
        );
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StockTransferRequest $request)
    {
        $stockTransfer = StockTransfer::create($request->validated());
        return new StockTransferResource($stockTransfer);
    }

    /**
     * Display the specified resource.
     */
    public function show(StockTransfer $stockTransfer)
    {
        return new StockTransferResource($stockTransfer);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(StockTransferRequest $request, StockTransfer $stockTransfer)
    {
        $stockTransfer->update($request->validated());
        return new StockTransferResource($stockTransfer);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StockTransfer $stockTransfer)
    {
        $stockTransfer->delete();
         return response()->json([
            'message' => 'Stock deleted successfully',
        ]);
    }
}
