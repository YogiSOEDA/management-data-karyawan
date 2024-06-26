@extends('layouts.main')

@include('partials.content-header')

@section('content_body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card card-primary card-outline">

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Nama Karyawan</label>
                            <input type="text" class="form-control" name="name" id="name"
                                value="{{ $data->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                value="{{ $data->username }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="join_date">Tanggal Bergabung</label>
                            <input type="date" class="form-control" name="join_date" id="join_date"
                                value="{{ $data->join_date }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="unit">Unit</label>
                            <input type="text" class="form-control" name="unit" id="unit" value="{{ $data->unit->name }}" readonly>
                            {{-- <select class="select2 form-control" id="unit" name="unit" style="width: 100%" required>
                            </select> --}}
                        </div>
                        <div class="form-group">
                            <label for="position">Jabatan</label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ $position }}" readonly>
                            {{-- <select class="select2 select2-primary select2bs4 form-control" id="position" name="position[]"
                                multiple="multiple" style="width: 100%" required>
                            </select> --}}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
