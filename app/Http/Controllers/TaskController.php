<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Category;

class TaskController extends Controller
{
    // Menampilkan list task
    public function index()
    {
        $tasks = Task::with('user', 'category')->get();
        return view('tasks', compact('tasks'));
    }

    // Menampilkan form edit task
    public function edit($id)
    {
        $task = Task::findOrFail($id);
        $categories = Category::all(); // Mengambil semua kategori untuk opsi dropdown
        return view('editTask', compact('task', 'categories'));
    }

    // Menyimpan update task
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task = Task::findOrFail($id);
        $task->description = $request->description;
        $task->category_id = $request->category_id;
        $task->save();

        return redirect()->route('tasks.index')->with('success', 'Task berhasil diupdate');
    }

    public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus');
}

}
