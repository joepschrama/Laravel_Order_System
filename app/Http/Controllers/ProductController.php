<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|string|max:255',
            'description' => 'required|string|max:100',
            'ingredients' => 'required|string|max:200',
            'category' => 'required',
        ]);
        $product = new Product;
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->ingredients = $data['ingredients'];
        $product->category_id = $data['category'];
        $product->save();

        return redirect('/product')->with('success', 'Product has been added');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('product.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'price' => 'required|string|max:255',
            'description' => 'required|string|max:100',
            'ingredients' => 'required|string|max:200',
            'category' => 'required',
        ]);
        $product->name = $data['name'];
        $product->price = $data['price'];
        $product->description = $data['description'];
        $product->ingredients = $data['ingredients'];
        $product->category_id = $data['category'][0];
        $product->save();

        return redirect('/product')->with('success', 'Product has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect('/product')->with('success', 'Product has been deleted');
    }
}
