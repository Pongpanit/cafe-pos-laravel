<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function toggleActive(Request $request)
    {
        $product = Product::find($request->id);
        $product->active = !$product->active;
        $product->save();

        return response()->json(['success' => true, 'active' => $product->active]);
    }
    
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price_hot' => 'nullable|numeric',
            'price_cold' => 'nullable|numeric',
            'price_blended' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->category_id = $request->category_id;  // กำหนด category_id ให้กับ product
        $product->price_hot = $request->price_hot;
        $product->price_cold = $request->price_cold;
        $product->price_blended = $request->price_blended;

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $product->image = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all(); // ดึงข้อมูล category ทั้งหมด
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }
}
