<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // ดึงข้อมูลหมวดหมู่สินค้า พร้อมกับสินค้าที่อยู่ในหมวดหมู่ที่ใช้งานอยู่
        $categories = Category::with(['products' => function ($query) {
            $query->where('active', true);
        }])->get();
        
        return view('sales.index', compact('categories'));
    }

    public function placeOrder(Request $request)
    {
        $orders = $request->input('orders');

        if (is_array($orders) && !empty($orders)) {
            foreach ($orders as $order) {
                Sale::create([
                    'product_name' => $order['name'],       // ชื่อสินค้า
                    'quantity' => $order['quantity'],       // จำนวนสินค้า
                    'price' => $order['price'],             // ราคาสินค้าต่อหน่วย
                    'total' => $order['price'] * $order['quantity'], // รวมราคา
                    'sale_date' => now(),
                ]);
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'No items to place order.'], 400);
    }



    public function history()
    {
        // ดึงข้อมูลการขายทั้งหมดและแสดงในหน้า Sales History
        $sales = Sale::all();
        return view('sales.history', compact('sales'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }
}
