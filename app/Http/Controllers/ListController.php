<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\User;
use App\Models\Distributor;
use Illuminate\Http\Request;
use App\Models\ItemList; 

class ListController extends Controller
{
    public function index()
    {
        $admins = Admin::all();
        $users = User::all();

        return view('welcome', compact('admins', 'users'));
    }

    public function create()
    {
        // Implementasi untuk membuat resource baru, jika diperlukan
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Implementasi untuk menyimpan data baru, jika diperlukan
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemList $list)
    {
        // Implementasi untuk menampilkan data spesifik, jika diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemList $list)
    {
        // Implementasi untuk menampilkan form edit, jika diperlukan
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemList $list)
    {
        // Implementasi untuk memperbarui data, jika diperlukan
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemList $list)
    {
        // Implementasi untuk menghapus data, jika diperlukan
    }
}