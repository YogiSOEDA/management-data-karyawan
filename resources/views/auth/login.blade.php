@extends('adminlte::auth.login')

@section('auth_body')
    <form action="{{ route('login') }}" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="input-group mb-3">
            <input type="username" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                placeholder="Username" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-user"></span>
                </div>
            </div>
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" placeholder="Password" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="row">
            <div class="col-12">
                <div class="col-5 float-sm-right">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
            </div>
        </div>
    </form>
@endsection
