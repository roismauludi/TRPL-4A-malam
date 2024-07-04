@extends('base.base')

@section('content')

<div class="container">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header" style="background-color: grey;">
                <p style="color:white;"> Edit Pengguna</p>
            </div>
            <div class="card-body">
                @if(session('notifikasi'))
                <div class="alert alert-{{ session('type') }}">
                    {{ session('notifikasi') }}
                </div>
                @endif

                <form action="{{ route('admin.update', ['id' => $user->id_staff]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $user->nama }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password </label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Pengguna</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('title', 'Edit Staff Data')
