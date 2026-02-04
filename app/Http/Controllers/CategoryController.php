<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // แสดงรายการหมวดหมู่ทั้งหมด
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // แสดงสินค้าตามหมวดหมู่ที่เลือก
    public function show($category)
    {
        // ดึงข้อมูลหมวดหมู่โดยใช้ $category ที่รับมา
        $category = Category::where('name', $category)->first();

        if ($category) {
            // ดึงสินค้าที่อยู่ในหมวดหมู่ที่เลือก
            $products = Product::where('category_id', $category->id)->get();
            return view('categories.show', compact('products', 'category'));
        } else {
            return redirect()->route('categories.index')->withErrors('Category not found');
        }
    }
}
