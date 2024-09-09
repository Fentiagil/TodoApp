<!-- resources/views/form.blade.php -->
@extends('adminlte::page')
<meta name="csrf-token" content="{{ csrf_token() }}">
@section('title', 'Form')

@section('content')
    <div style="padding: 50px; background: #FAFAFA; min-height:100vh" class="container">
        
        {{-- LOGO ENERGEEK --}}
        <div style="text-align: center;">
            <img src="{{ asset('img/energeek.png') }}" alt="Energeek Logo" style="max-width: 200px;">
        </div> <br/>


        {{-- FORM INPUT DATA --}}
        <form id="todo-form">
            @csrf

            {{-- FORM DATA USER --}}
            <div style="display: flex; justify-content: space-between; gap: 20px; background: white; padding: 20px; border-radius: 10px;">
                <div class="form-group" style="flex: 1;">
                    <label for="name" style="font-family: Poppins; font-size: 16px; font-weight: 400; line-height: 22.4px; text-align: left;">Nama</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama" required style="font-family: Poppins; font-size: 16px; font-weight: 400; line-height: 22.4px;">
                </div>
            
                <div class="form-group" style="flex: 1;">
                    <label for="username" style="font-family: Poppins; font-size: 16px; font-weight: 400; line-height: 22.4px; text-align: left;">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required style="font-family: Poppins; font-size: 16px; font-weight: 400; line-height: 22.4px;">
                </div>
            
                <div class="form-group" style="flex: 1;">
                    <label for="email" style="font-family: Poppins; font-size: 16px; font-weight: 400; line-height: 22.4px; text-align: left;">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" required style="font-family: Poppins; font-size: 16px; font-weight: 400; line-height: 22.4px;">
                </div>
            </div><br/>


            {{-- BUTTON TAMBAH TO DO LIST --}}
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <!-- Tulisan Todo List -->
                <h2 style="font-family: Inter; font-size: 22px; font-weight: 500; line-height: 30.8px; text-align: left;">Todo List</h2>
        
                <!-- Tombol Tambah -->
                <button type="button" id="add-todo-btn" class="btn" style="font-family: Inter; font-size: 18px; font-weight: 500; line-height: 21.78px; text-align: center; width: 200px; height: 47px;  padding: 10px 20px; gap: 16px;  border-radius: 12px; background-color: #FFE2E5; color: #F1416C; opacity: 1;"> + Tambah To Do </button>
            </div>


            {{-- FORM TO DO --}}
            <div id="todo-container">
                <!-- Div Todo Item Awal -->
                <div class="todo-item" style="display: flex; justify-content: space-between; align-items: center; gap: 20px;  border-radius: 10px; margin-bottom: 10px;">
                    <div style="flex: 3;">
                        <label for="todo-title-1" style="font-family: Inter; font-size: 16px; font-weight: 400; line-height: 22.4px; color: #3F4254;">Judul To-Do</label>
                        <input type="text" id="todo-title-1" name="todo-title[]" placeholder="Contoh : Perbaikan Api Master" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd; box-sizing: border-box;">
                    </div>
                    <div style="flex: 1;">
                        <label for="category-1" style="font-family: Inter; font-size: 16px; font-weight: 400; line-height: 22.4px; color: #3F4254;">Kategori</label>
                        <select id="category-1" name="category[]" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd; box-sizing: border-box;">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="button" class="btn-delete" style="padding: 10px; background: none; border: none; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <img src="{{ asset('img/del.png') }}" alt="Delete">
                    </button>
                </div><br/>
                <!-- Akhir Div Todo Item Awal -->
            </div> <br/>        
            

            {{-- BUTTON SUBMIT --}}
            <button type="submit" style=" width: 100%;  height: 47px; padding: 10px 20px; border-radius: 12px; background: #049C4F; color: #fff; border: none;  font-family: Inter, sans-serif; font-size: 16px; font-weight: 400; line-height: 22.4px; text-align: center;  opacity: 1;">
                SIMPAN
            </button>
        </form>
    </div>

    <!-- Modal Bootstrap -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-body">
                    <img src="{{ asset('img/check.png') }}" alt="logo berhasil"><br/>
                    <h3>Berhasil!</h3>
                    <p>To do berhasil ditambahkan</p>
                    <button type="button" class="btn" data-bs-dismiss="modal" style="background: #50CD89; color:white; border: none;
                    ">Selesai</button>
                </div>
            </div>
        </div>
    </div>

     <!-- Modal Konfirmasi Hapus -->
     <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-body">
                    <img src="{{ asset('img/alert.png') }}" alt="logo berhasil"><br/>
                    <h3>Apakah Anda Yakin?</h3>
                    <p>To do yang dihapus tidak dapat dikembalikan</p>
                </div>
                <div class="modal-footer" style="display: flex; justify-content: center; gap: 10px;">
                    <button type="button" class="btn btn-danger" id="confirm-delete-btn" style="background: #F64E60; border: none;
                    ">Ya, Hapus</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background: #F3F6F9; color: #7E8299; border: none;
                    ">Batal</button>
                    
                </div>
            </div>
        </div>
    </div>

     <!-- Modal Berhasil Dihapus -->
     <div class="modal fade" id="successDeleteModal" tabindex="-1" aria-labelledby="successDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="text-align: center;">
                <div class="modal-body">
                    <img src="{{ asset('img/check.png') }}" alt="logo berhasil"><br/>
                    <h3>Berhasil!</h3>
                    <p>To do berhasil dihapus</p>
                    <button type="button" class="btn" data-bs-dismiss="modal" style="background: #50CD89; color:white; border: none;
                    ">Selesai</button>
                </div>
            </div>
        </div>
    </div>
@stop

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script>
    axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
</script>
<script>
let todoToDelete;
document.addEventListener('DOMContentLoaded', function() {


    // KONFIRMASI HAPUS
    document.getElementById('todo-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-delete') || e.target.closest('.btn-delete')) {
            // Simpan referensi item yang akan dihapus
            todoToDelete = e.target.closest('.todo-item');
                    
            // Tampilkan modal konfirmasi hapus
            var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }
    });

    // BERHASIL HAPUS 
    document.getElementById('confirm-delete-btn').addEventListener('click', function() {
                if (todoToDelete) {

                    // Hapus item
                    todoToDelete.remove();
                      // Tampilkan modal sukses dihapus
                    var successDeleteModal = new bootstrap.Modal(document.getElementById('successDeleteModal'));
                    successDeleteModal.show();

                    // Tutup modal konfirmasi hapus dan setelah itu tampilkan modal sukses
                    var deleteModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));                   
                    deleteModal.hide();  // Tutup modal konfirmasi
                  
                }
            });


    // SUBMIT FORM TO DO
    document.getElementById('todo-form').addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                axios.post('/submit', formData)
                    .then(function(response) {
                        // Menampilkan modal sukses
                        var successModal = new bootstrap.Modal(document.getElementById('successModal'));
                        successModal.show();

                        // Optionally reset the form
                        document.getElementById('todo-form').reset();
                        document.getElementById('todo-container').innerHTML = ''; // Reset todo items
                    })
                    .catch(function(error) {
                        if (error.response && error.response.status === 409) {
                            // Tampilkan notifikasi error jika pengguna sudah ada
                            alert(error.response.data.error); // Ini bisa diganti dengan tampilan modal atau toast
                        } else {
                            console.error('Error:', error);
                        }
                    });
            });


    // TAMBAH TO DO LIST
    document.getElementById('add-todo-btn').addEventListener('click', function() {
    const container = document.getElementById('todo-container');
    const index = container.children.length + 1;
    const categoriesOptions = @json($categories).map(category => `<option value="${category.id}">${category.name}</option>`).join('');
    
    const newTodoItem = document.createElement('div');
    newTodoItem.className = 'todo-item';
    newTodoItem.style = "display: flex; justify-content: space-between; align-items: center; gap: 20px; border-radius: 10px; margin-bottom: 15px;";
    newTodoItem.innerHTML = `
        <!-- Input Judul Todo -->
        <div style="flex: 3;">
            <label for="todo-title-${index}" style="font-family: Inter; font-size: 16px; font-weight: 400; line-height: 22.4px; color: #3F4254;">Judul To-Do</label>
            <input type="text" id="todo-title-${index}" name="todo-title[]" placeholder="Contoh : Perbaikan Api Master" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd; box-sizing: border-box;">
        </div>
        <div style="flex: 1;">
            <label for="category-${index}" style="font-family: Inter; font-size: 16px; font-weight: 400; line-height: 22.4px; color: #3F4254;">Kategori</label>
            <select id="category-${index}" name="category[]" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd; box-sizing: border-box;">
                ${categoriesOptions}
            </select>
        </div>
        <button type="button" class="btn-delete" style="padding: 10px; background: none; border: none; cursor: pointer;">
            <img src="{{ asset('img/del.png') }}" alt="Delete">
        </button>`;
    container.appendChild(newTodoItem);
    });

});

</script>




