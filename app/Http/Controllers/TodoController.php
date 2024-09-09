<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;

class TodoController extends Controller
{
     // New index method to fetch categories
    public function indexCategories()     
    {
         // Get all categories from the database
         $categories = Category::all();
 
         // Return categories as JSON response
         return view('form', compact('categories'));
    }

    public function getCategories()     
    {
         // Get all categories from the database
         $categories = Category::all();
 
         // Return categories as JSON response
         return view('categories', compact('categories'));
    }

    public function indexUsers()     
    {
         // Get all categories from the database
         $users = User::all();
 
         // Return categories as JSON response
         return view('users', compact('users'));
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'todo-title.*' => 'required|string',
            'category.*' => 'required|int',
        ]);

        // Cek apakah pengguna dengan name atau email yang sama sudah ada
            $existingUser = User::where('name', $request->name)
            ->orWhere('email', $request->email)
            ->first();

        if ($existingUser) {
            return response()->json(['error' => 'Pengguna dengan nama atau email yang sama sudah ada!'], 409); // 409 adalah kode HTTP untuk konflik
        }

        // Simpan data ke tabel users
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'created_by' => 1, // ID default atau admin
            'updated_by' => 1, // ID default atau admin
        ]);

        // Simpan data ke tabel tasks
        foreach ($validatedData['todo-title'] as $key => $title) {
            Task::create([
                'user_id' => $user->id,
                'category_id' => $validatedData['category'][$key],
                'description' => $title,
                'created_by' => 1, // ID default atau admin
                'updated_by' => 1, // ID default atau admin
            ]);
        }

        // Mengembalikan response sukses ke frontend
        return response()->json(['message' => 'Data berhasil disimpan!'], 200);
    }
}
