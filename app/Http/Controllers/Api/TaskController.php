<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class TaskController extends Controller
{
    // Menampilkan list task
    public function index(): JsonResponse
    {
        $tasks = Task::with('user', 'category')->get();
        return response()->json($tasks);
    }

    // Menampilkan detail task
    public function show($id): JsonResponse
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    // Menyimpan update task
    public function update(Request $request, $id): JsonResponse
    {
        $request->validate([
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task = Task::findOrFail($id);
        $task->description = $request->description;
        $task->category_id = $request->category_id;
        $task->save();

        return response()->json([
            'message' => 'Task berhasil diupdate',
            'task' => $task
        ]);
    }

    // Menghapus task
    public function destroy($id): JsonResponse
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json([
            'message' => 'Task berhasil dihapus'
        ]);
    }
}

