<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use GuzzleHttp\Handler\Proxy;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderby('created_at')->get();
        return view('products.index', ["products" => $products]);
    }

    public function create(){
        return view('products.create');
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2028'
        ]);

        $product = new Product;
    
        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $file_name);
    
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $file_name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
    
        $product->save();
        return redirect()->route('products.index')->with('success', 'Produto adicionado com sucesso!');
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        return view('products.edit', ['product'=>$product]);
    }

    public function update(Request $request, Product $product){
        $request->validate([
            'name' => 'required'
        ]);

        $file_name = $request->hidden_product_image;

        if ($request->image != '') {
            $file_name = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);
        }

        $product = Product::find($request->hidden_id);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $file_name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
    
        $product->save();
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        $image_path = public_path()."/images/";
        $image = $image_path. $product->image;
        if(file_exists($image)){
            @unlink($image);
        }
        $product->delete();
        return redirect('products')->with('sucess', 'Produto deletado!');
    }
    
}
