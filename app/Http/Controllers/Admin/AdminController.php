<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
Use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::count();
        $user = User::count();

        return view('pages.admin.index', compact('product', 'users'));
    }
}