@extends('adminlte::page')

@section('title', 'Task')

@section('content')
<div style="padding: 50px; background: #FAFAFA; min-height:100vh" class="container">

    {{-- LOGO ENERGEEK --}}
    <div style="text-align: center;">
        <img src="{{ asset('img/energeek.png') }}" alt="Energeek Logo" style="max-width: 200px;">
    </div> <br/>

    {{-- TABEL TASK --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Deskripsi Task</th>
                    <th>Kategori</th>
                    <th>Dibuat Pada</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $task->user->name }}</td>
                    <td>{{ $task->description }}</td>
                    <td>{{ $task->category->name }}</td>
                    <td>{{ $task->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    
                        <!-- Trigger modal -->
                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal-{{ $task->id }}">
                            Hapus
                        </button>
                    
                        <!-- Modal Konfirmasi Hapus -->
                        <div class="modal fade" id="deleteModal-{{ $task->id }}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content" style="text-align: center;">
                                    <div class="modal-body">
                                        <img src="{{ asset('img/alert.png') }}" alt="logo alert" style="max-width: 100px;"><br/>
                                        <h3>Apakah Anda Yakin?</h3>
                                        <p>Task yang dihapus tidak dapat dikembalikan.</p>
                                    </div>
                                    <div class="modal-footer" style="display: flex; justify-content: center; gap: 10px;">
                                        <button type="button" class="btn btn-danger" id="confirm-delete-btn" 
                                            style="background: #F64E60; border: none;" 
                                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $task->id }}').submit();">
                                            Ya, Hapus
                                        </button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" 
                                            style="background: #F3F6F9; color: #7E8299; border: none;">
                                            Batal
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Form Hapus -->
                        <form id="delete-form-{{ $task->id }}" action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>
                    
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada task</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div><br/><br/>

    {{-- BUTTON BACK --}}
    <a href="/" class="btn btn-primary" style=" padding: 10px 20px; border-radius: 12px; border: none; font-family: Inter, sans-serif; font-size: 16px; font-weight: 400; line-height: 22.4px; text-align: center; opacity: 1;">
        KEMBALI
    </a>

    
    <!-- Modal Berhasil Dihapus -->
    <div class="modal fade" id="successDeleteModal" tabindex="-1" aria-labelledby="successDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-body">
                    <img src="{{ asset('img/check.png') }}" alt="logo berhasil" style="max-width: 100px;"><br/>
                    <h3>Berhasil!</h3>
                    <p>Task berhasil dihapus.</p>
                    <button type="button" class="btn" data-bs-dismiss="modal" style="background: #50CD89; color:white; border: none;">
                        Selesai
                    </button>
                </div>
            </div>
        </div>
    </div>


</div>
@stop
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    @if(session('success'))
        var successModal = new bootstrap.Modal(document.getElementById('successDeleteModal'), {
            keyboard: false
        });
        successModal.show();
    @endif
</script>


