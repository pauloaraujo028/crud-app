<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return response()->json([
            'success' => true,
            'data' => $products
        ]);
    }

    public function store(Request $request)
    {
        $product = new Product;
        $product->name = $request->name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;

        if ($product->save()) {
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product could not be created'
            ]);
        }
    }

    public function show($id)
    {
        $product = Product::find($id);

        if ($product) {
            return response()->json([
                'success' => true,
                'data' => $product
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->name = $request->name;
            $product->category = $request->category;
            $product->quantity = $request->quantity;
            $product->price = $request->price;

            if ($product->save()) {
                return response()->json([
                    'success' => true,
                    'data' => $product
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Product could not be updated'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }
    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            if ($product->delete()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Product has been deleted'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Product could not be deleted'
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found'
            ]);
        }
    }
}
