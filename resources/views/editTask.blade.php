@extends('adminlte::page')

@section('title', 'Edit Task')

@section('content')
<div style="padding: 50px; background: #FAFAFA; min-height:100vh" class="container">
    
    {{-- LOGO ENERGEEK --}}
    <div style="text-align: center;">
        <img src="{{ asset('img/energeek.png') }}" alt="Energeek Logo" style="max-width: 200px;">
    </div> <br/>

    {{-- FORM EDIT TASK --}}
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="description">Deskripsi Task</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $task->description }}" required>
        </div>

        <div class="form-group">
            <label for="category_id">Kategori</label>
            <select class="form-control" id="category_id" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $task->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Batal</a>
    </form>

</div>
@stop
