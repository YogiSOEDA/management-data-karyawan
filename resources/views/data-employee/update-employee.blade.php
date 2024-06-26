@extends('layouts.main')

@include('partials.content-header')

@push('css')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('content_body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card card-primary card-outline">
                    <form action="{{ route('storeEmployee') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Karyawan</label>
                                <input type="text" class="form-control" name="name" id="name"
                                    placeholder="Masukkan Nama Karyawan" required>
                            </div>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" id="username"
                                    placeholder="Masukkan Username" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password"
                                    placeholder="Masukkan Password" required>
                            </div>
                            <div class="form-group">
                                <label for="join_date">Tanggal Bergabung</label>
                                <input type="date" class="form-control" name="join_date" id="join_date"
                                    placeholder="Masukkan Tanggal Bergabung" required>
                            </div>
                            <div class="form-group">
                                <label for="unit">Unit</label>
                                <select class="select2 form-control" id="unit" name="unit" style="width: 100%"
                                    required>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="position">Jabatan</label>
                                <select class="select2 select2-primary select2bs4 form-control" id="position"
                                    name="position[]" multiple="multiple" style="width: 100%" required>
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="float-sm-right">
                                    <button class="btn btn-success" type="submit">Simpan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
@endpush
