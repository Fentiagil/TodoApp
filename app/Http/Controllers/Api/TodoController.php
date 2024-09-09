<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class TodoController extends Controller
{
    // Menampilkan kategori
    public function indexCategories(): JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Mengambil kategori
    public function getCategories(): JsonResponse
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Menampilkan pengguna
    public function indexUsers(): JsonResponse
    {
        $users = User::all();
        return response()->json($users);
    }

    // Menyimpan data pengguna dan tugas
    public function store(Request $request): JsonResponse
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'name' => 'required|string',
            'username' => 'required|string',
            'email' => 'required|email',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'created_by' => 'required|integer',
            'updated_by' => 'required|integer',
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
            'created_by' => $validatedData['created_by'],
            'updated_by' => $validatedData['updated_by'],
        ]);

        // Simpan data ke tabel tasks
        Task::create([
            'user_id' => $user->id,
            'category_id' => $validatedData['category_id'],
            'description' => $validatedData['description'],
            'created_by' => $validatedData['created_by'],
            'updated_by' => $validatedData['updated_by'],
        ]);

        // Mengembalikan response sukses
        return response()->json(['message' => 'Data berhasil disimpan!'], 200);
    }
}

