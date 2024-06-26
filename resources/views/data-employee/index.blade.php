@extends('layouts.main')

@include('partials.content-header')

@push('css')
    @include('partials.stylesheet-head')
@endpush

@section('content_body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="float-sm-right">
                            <a href="{{ route('createEmployee') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                                Tambah Data
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="data-employee" class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Username</th>
                                    <th>Jabatan</th>
                                    <th>Unit</th>
                                    <th>Tgl Bergabung</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    @include('partials.script')

    <script>
        $(document).ready(function() {
            table();
        });

        function table() {
            $('#data-employee').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('data-karyawan/tabel') }}"
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '7%',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'username',
                        name: 'username',
                    },
                    {
                        data: 'position',
                        name: 'position',
                    },
                    {
                        data: 'unit.name',
                        name: 'unit.name',
                    },
                    {
                        data: 'join_date',
                        name: 'join_date',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        width: '20%',
                        orderable: false,
                        searchable: false
                    },
                ],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-body-left',
                    targets: 1
                }],
            });
        }

        function detail(id) {
            window.location.href = "{{ url('data-karyawan') }}/" + id;
        }

        function edit(id) {
            window.location.href = "{{ url('data-karyawan') }}/" + id + "/edit";
        }
    </script>
@endpush
