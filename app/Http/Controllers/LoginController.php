<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    // ฟังก์ชันแสดงฟอร์ม Login
    public function showLoginForm()
    {
        return view('login'); // โหลดหน้า login.blade.php
    }

    public function processLogin(Request $request)
    {
        $email = $request->input('username'); // รับอีเมล
        $password = $request->input('password'); // รับรหัสผ่าน

        // ตรวจสอบว่าเป็นอีเมลและรหัสผ่านของผู้ใช้ Admin เท่านั้น
        if ($email === 'Admin@gmail.com' && $password === 'Admin123') {
            Session::put('logged_in', true); // เก็บสถานะการเข้าสู่ระบบใน Session
            return redirect()->route('sales.index'); 
        } else {
            // ถ้าอีเมลหรือรหัสผ่านไม่ถูกต้อง
            return redirect()->route('login')->withErrors(['อีเมลหรือรหัสผ่านไม่ถูกต้อง']);
        }
    }
}
