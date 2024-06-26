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
                            <button class="btn btn-primary" onclick="create()">
                                <i class="fas fa-plus"></i>
                                Tambah Data
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="data-unit" class="table table-bordered table-hover text-center">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Unit</th>
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
    @include('partials.modal')
@endsection

@push('js')
    @include('partials.script')

    <script>
        $(document).ready(function() {
            table();
        });

        function table() {
            $('#data-unit').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('data-unit/tabel') }}"
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
                        data: 'action',
                        name: 'action',
                        width: '30%',
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

        // function table() {
        //     $('#data-unit').DataTable({
        //         ordering: true,
        //         serverSide: true,
        //         processing: true,
        //         ajax: {
        //             'url' : "{{ url('data-unit/tabel') }}"
        //         },
        //         colums: [
        //             {
        //                 data: 'DT_RowIndex',
        //                 name: 'DT_RowIndex',
        //                 width: '13px',
        //                 orderable: false,
        //                 searchable: false,
        //             },
        //         ],
        //         responsive: true,
        //         autoWidth: true,
        //         // columDefs: [
        //         //     {
        //         //         className: 'dt'
        //         //     }
        //         // ],
        //     });
        // }

        function create() {
            $.get("{{ url('data-unit/create') }}", {}, function(data, status) {
                $('#modal-page').html(data);
                $('#modal-title').html('Tambah Data Unit');
                $('#ModalData').modal('show');
            });
        }
    </script>
@endpush
