@extends('panel.layouts.auth')
@section('title', 'PPID | Login')
@section('content')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="../../index2.html" class="h1"><b>PPID</b> Panel</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Login untuk memulai sesi</p>

                <form action="{{ route('panel.auth.login') }}" method="post" id="login-form">
                    @csrf
                    @if ($errors->has('invalid'))
                        <div class="alert alert-danger alert-dismissible" id="invalid-alert">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            {{ $errors->first('invalid') }}
                        </div>
                    @endif
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="text" id="nip" name="nip" class="form-control" placeholder="NIP">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="nip-empty-error">NIP wajib diisi.</small>
                        <small class="text-danger d-none" id="nip-format-error">NIP hanya boleh berupa angka.</small>
                        @if ($errors->has('nip'))
                            <small class="text-danger" id="server-nip-error">{{ $errors->first('nip') }}</small>
                        @endif
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <small class="text-danger d-none" id="password-error">Kata sandi tidak boleh
                            kosong.</small>
                        @if ($errors->has('password'))
                            <small class="text-danger" id="server-password-error">{{ $errors->first('password') }}</small>
                        @endif

                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember">
                                <label for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                        <!-- /.col -->
                    </div>
                    <p class="mb-1">
                        <a href="forgot-password.html">Lupa kata sandi?</a>
                    </p>
            </div>

            </form>


        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
@push('scripts')
    <script>
        $('#login-form').on('submit', function (e) {
            let valid = false;

            const nip = $('#nip').val().trim();
            const password = $('#password').val().trim();

            // Reset semua error message
            $('#invalid-alert').addClass('d-none');
            $('#nip-empty-error').addClass('d-none');
            $('#nip-format-error').addClass('d-none');
            $('#password-error').addClass('d-none');
            $('#server-password-error').addClass('d-none');
            $('#server-nip-error').addClass('d-none');

            let nipValid = true;
            let passwordValid = true;

            // Validasi NIP
            if (nip === '') {
                $('#nip-empty-error').removeClass('d-none');
                nipValid = false;
            } else if (!/^\d+$/.test(nip)) {
                $('#nip-format-error').removeClass('d-none');
                nipValid = false;
            }

            // Validasi Password
            if (password === '') {
                $('#password-error').removeClass('d-none');
                passwordValid = false;
            }

            // Semua valid
            if (nipValid && passwordValid) {
                valid = true;
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    </script>
@endpush