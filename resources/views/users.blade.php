@extends('adminlte::page')

@section('title', 'Users')

@section('content')
<div style="padding: 50px; background: #FAFAFA; min-height:100vh" class="container" >

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
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->email }}</td>
                    
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data user</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div><br/><br/>

    {{-- BUTTON BACK --}}
    <a href="/" class="btn btn-primary" style=" padding: 10px 20px; border-radius: 12px; border: none; font-family: Inter, sans-serif; font-size: 16px; font-weight: 400; line-height: 22.4px; text-align: center; opacity: 1;">
        KEMBALI
    </a>



</div>
@stop
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>



