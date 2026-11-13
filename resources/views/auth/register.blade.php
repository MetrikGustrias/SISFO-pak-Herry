@extends('layouts.app')

@section('title', 'Registrasi')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            @include('auth.partials.illustration', ['cols' => 'lg-5'])
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-group">
                                        <input type="text" id="name" name="name" placeholder="Nama Lengkap"
                                            class="form-control form-control-user @error('name') is-invalid @enderror" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback ml-3" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                        <div class="form-group">
                                        <input type="email" id="email" name="email" placeholder="Alamat Email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror" value="{{ old('email') }}" required autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback ml-3" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" id="password" name="password" placeholder="Kata Sandi"
                                                    class="form-control form-control-user @error('password') is-invalid @enderror"
                                                    required autocomplete="new-password">
                                                @error('password')
                                                    <span class="invalid-feedback ml-3" role="alert"><strong>{{ $message }}</strong></span>
                                                @enderror
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" id="password-confirm" name="password_confirmation"
                                                    class="form-control form-control-user" placeholder="Ulangi Kata Sandi"
                                                    required autocomplete="new-password">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Daftar Akun</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('login') }}">Sudah punya akun? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
