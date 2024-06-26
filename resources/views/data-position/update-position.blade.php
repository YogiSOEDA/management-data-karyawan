<form action="/data-jabatan/{{ $data->id }}/update" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}

    <div class="form-group">
        <label for="name">Nama Jabatan</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan Nama Jabatan" value="{{ $data->name }}" required>
    </div>
    <div class="form-group">
        <div class="float-sm-right">
            <button class="btn btn-success" type="submit">Simpan</button>
        </div>
    </div>
</form>
