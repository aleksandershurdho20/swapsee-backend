<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::latest()->get();
    
            return response()->json([
                'success' => true,
                'message' => 'Products retrieved successfully.',
                'data'    => $products,
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve products.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $validated = $request->validated();
    
            $validated['created_by'] = auth()->id();
            $validated['updated_by'] = auth()->id();
    
            $product = Product::create($validated);
    
            return response()->json([
                'success' => true,
                'message' => 'Product created successfully!',
                'data'    => $product,
            ], 201);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the product.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $product = Product::findOrFail($id);
    
            $product->update($request->all());
    
            return response()->json([
                'success' => true,
                'message' => 'Product updated successfully.',
                'data'    => $product,
            ], 200);
    
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found.',
            ], 404);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update product.',
                'error'   => app()->environment('local') ? $e->getMessage() : null,
            ], 500);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
