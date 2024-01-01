@extends('auth.app')
@section('title')
    Register
@endsection
@section('content')
    <section class="section">
        <div class="container mt-5">
            <div class="row mt-5 justify-content-center">
                <div class="col-md-5">
                    <div class="login-brand mb-5">
                        {{-- <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
                    </div>

                    <div class="card card-primary mt-5">
                        <div class="card-header">
                            <h4>Register</h4>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('register') }}" class="needs-validation" novalidate="">
                                @csrf
                                <div class='form-group mb-3'>
                                    <label for='name' class='mb-2'>Nama</label>
                                    <input type='text' name='name'
                                        class='form-control @error('name') is-invalid @enderror'
                                        value='{{ old('name') }}'>
                                    @error('name')
                                        <div class='invalid-feedback'>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" tabindex="1" required autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                    </div>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        tabindex="2" required>
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password_confirmation" class="control-label">Konfirmasi Password</label>
                                    </div>
                                    <input id="password_confirmation" type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        name="password_confirmation" tabindex="2" required>
                                    @error('password_confirmation')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Register
                                    </button>
                                </div>
                            </form>
                            <p>Sudah punya akun? Silahkan <a href="{{ route('login') }}">Login</a></p>
                            <p>Kembali ke <a href="{{ route('home') }}">Home</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
