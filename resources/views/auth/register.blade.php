@extends('adminlte::auth.register')

@push('css')
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('AdminLTE/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@section('auth_body')
    <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="name">Nama Karyawan</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Karyawan"
                required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan Username"
                required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan Password"
                required>
        </div>
        <div class="form-group">
            <label for="join_date">Tanggal Bergabung</label>
            <input type="date" class="form-control" name="join_date" id="join_date"
                placeholder="Masukkan Tanggal Bergabung" required>
        </div>
        <div class="form-group">
            <label for="unit">Unit</label>
            <select class="select2 form-control" id="unit" name="unit" style="width: 100%" required>
            </select>
        </div>
        <div class="form-group">
            <label for="position">Jabatan</label>
            <select class="select2 select2-primary select2bs4 form-control" id="position" name="position[]"
                multiple="multiple" style="width: 100%" required>
            </select>
        </div>

        <div class="form-group">
            <div class="float-sm-right">
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="{{ asset('AdminLTE/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            select2();

            selectUnit();
            selectPosition();

        });

        function select2() {
            var unitSelect2 = $('#unit').select2({
                tags: true,
                createTag: function(params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }

                    return {
                        id: term,
                        text: term,
                        newTag: true
                    };
                },
                templateResult: function(data) {
                    var $result = $('<span></span>');

                    $result.text(data.text);

                    if (data.newTag) {
                        $result.append(' <em>(New Tag)</em>');
                    }

                    return $result;
                },
                placeholder: 'Select an option',
            });
            var positionSelect2 = $('#position').select2({
                tags: true,
                createTag: function(params) {
                    var term = $.trim(params.term);

                    if (term === '') {
                        return null;
                    }

                    return {
                        id: term,
                        text: term,
                        newTag: true
                    };
                },
                templateResult: function(data) {
                    var $result = $('<span></span>');

                    $result.text(data.text);

                    if (data.newTag) {
                        $result.append(' <em>(New Tag)</em>');
                    }

                    return $result;
                },
                placeholder: 'Select an option'
            });
            unitSelect2.data('select2').$selection.css('height', '1%');
            positionSelect2.data('select2').$selection.css('height', '1%');
        }

        function selectUnit() {
            $.get("{{ url('data-unit/dropdown') }}", {}, function(data, status) {
                $("#unit").html(data);
            });
        }

        function selectPosition() {
            $.get("{{ url('data-jabatan/dropdown') }}", {}, function(data, status) {
                $("#position").html(data);
            });
        }
    </script>
@endpush
