@extends('base.base')

@section('content')
<div class="container">
    <div class="content-wrapper">
        <section class="content">
            <section class="content-header">
                <h1>My Profile</h1>
                @if(session('notifikasi'))
                <div class="alert alert-{{ session('type') }}">
                    {{ session('notifikasi') }}
                </div>
                @endif
                <ol class="nav nav-tabs">
                </ol>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="box box-primary">
                            <div class="box-body box-profile">
                                <a href="#" data-toggle="modal" data-target="#previewModal">
                                    <img class="rounded-circle border-0" src="{{ asset('storage/foto/' . $user->foto)}}" alt="Foto Profil" width="120" height="120">
                                </a>

                                <h3 class="profile-username text-center">
                                    <div class="col-sm-15">
                                        <input type="text" class="form-control" value="{{ $user->nama }}" disabled="disabled">
                                    </div>
                                </h3>
                                <ul class="list-group list-group-unbordered">
                                    <li class="list-group-item">
                                        <i class="fa fa-envelope"></i> <input type="text" class="pull-right" value="{{ $user->email }}" disabled="disabled">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="nav-tabs-custom">

                            <div class="tab-content">
                                <div class="active tab-pane" id="profile">
                                    <form class="form-horizontal">
                                        <a href="/profil/edit/{{ $user->id_staff }}" class="btn btn-sm btn-warning my-1"><i class="bi bi-search"></i> Edit Profile</a>
                                        <div class="form-group">
                                            <label class="col-sm-3 control-label">Nama</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" value="{{ $user->nama }}" disabled="disabled">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
</div>

<!-- Modal untuk preview foto -->
<div class="modal fade" id="previewModal" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Preview Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/foto/' . $user->foto)}}" class="img-fluid" alt="Foto Profil">
            </div>
        </div>
    </div>
</div>
@endsection

@section('title', 'Profile Page')
