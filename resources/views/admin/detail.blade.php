@extends('base.base')

@section('content')

<div class="container">
    <div class="container-fluid mt-4">
        <div class="card">
            <div class="card-header" style="background-color: grey;">
                <p style="color:white;"> Data Staff</p>
            </div>
            @if(session('notifikasi'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('notifikasi') }}
            </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <td style="color:dark;">ID Staff</td>
                        <td style="color:dark;">Nama</td>
                        <td style="color:dark;">Email</td>
                        <td style="color:dark;">Foto</td>
                        <td style="color:dark;">Level</td>
                        @if(in_array(Auth::user()->level, ['admin']))
                        <td style="color:dark;">Aksi</td>
                        @endif
                    </thead>
                    <tbody>
                        @foreach ($user as $data)
                        <tr>
                            <td>{{ $data->id_staff }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>{{ $data->email }}</td>
                            <td>
                                <img class="img-fluid" src="{{ asset('storage/foto/' . $data->foto)}}">
                            </td>
                            <td>{{ $data->level }}</td>
                            @if(in_array(Auth::user()->level, ['admin']))
                            <td>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('admin.edit', ['id' => $data->id_staff]) }}" class="btn btn-sm btn-warning my-1"><i class="bi bi-pencil"></i> Edit Pengguna</a>
                                </div>
                            </td>


                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@section('title', 'Staff Details Page')