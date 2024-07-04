@extends('base.base')

@section('content')
<div class="container">

    <h1>Daftar Pengguna</h1>
    <table class="table table-bordered table-hover" style="margin-top: 1rem; background-color:white;">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID Staff</th>
                <th scope="col">Nama</th>
                <th scope="col">Level</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id_staff}}</td>
                <td>{{ $user->nama }}</td>
                <td>{{ $user->level }}</td>
                <td>
                    <div class="d-flex">
                        <a class="nav-link" href="/detail-{{ $user->id_staff }}">
                            <button class="btn btn-sm btn-primary mr-1">Detail</button>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
@section('title', 'Staff List Page')