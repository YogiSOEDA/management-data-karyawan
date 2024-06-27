@extends('layouts.main')

@push('css')
    @include('partials.stylesheet-head')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@section('content_header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item active">
                        Dashboard
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection
@section('content_body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <div class="float-sm-right">
                            <input type="text" id="daterange" name="daterange" />
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-info">
                                    <div class="inner">
                                        <h3 id="total-karyawan">{{ $total_employee }}</h3>
                                        <p>Total Karyawan</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-friends"></i>
                                    </div>
                                    <a href="{{ route('employee') }}" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-danger">
                                    <div class="inner">
                                        <h3 id="total-login">{{ $total_login }}</h3>
                                        <p>Total Login</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-sign-in-alt"></i>
                                    </div>
                                    <a href="#" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-success">
                                    <div class="inner">
                                        <h3>{{ $total_unit }}</h3>
                                        <p>Total Unit</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-universal-access"></i>
                                    </div>
                                    <a href="{{ route('unit') }}" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3>{{ $total_position }}</h3>
                                        <p>Total Jabatan</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-user-md"></i>
                                    </div>
                                    <a href="{{ route('position') }}" class="small-box-footer">
                                        More info <i class="fas fa-arrow-circle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="top-user" class="table table-bordered table-hover text-center">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jumlah Login</th>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="date" id="start-date" hidden>
    <input type="date" id="end-date" hidden>
@endsection

@push('js')
    @include('partials.script')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(document).ready(function() {
            table();

            dateRangePicker();
        });

        function table() {
            $('#top-user').DataTable({
                ordering: true,
                serverSide: true,
                processing: true,
                ajax: {
                    'url': "{{ url('dashboard/tabel') }}",
                    data: function(data) {
                        data.start_date = $('#start-date').val();
                        data.end_date = $('#end-date').val();
                    }
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
                        name: 'name'
                    },
                    {
                        data: 'login_log_count',
                        name: 'login_log_count',
                    },
                ],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    className: 'dt-body-left',
                    targets: 0
                }],
            });
        }

        function dateRangePicker() {
            $(function() {
                $('input[name="daterange"]').daterangepicker({
                    opens: 'left'
                }, function(start, end, label) {

                    var startDate = start.format('YYYY-MM-DD');
                    var endDate = end.format('YYYY-MM-DD');

                    $('#start-date').val(startDate);
                    $('#end-date').val(endDate);

                    $.ajax({
                        type: "get",
                        url: "{{ url('dashboard/filter-date') }}",
                        data: "start_date=" + startDate + "&end_date=" + endDate,
                        success: function(data) {
                            $('#total-karyawan').text(data.total_employee);
                            $('#total-login').text(data.total_login);

                            $('#top-user').DataTable().ajax.reload();

                        }
                    });
                });
            })
        }
    </script>
@endpush
