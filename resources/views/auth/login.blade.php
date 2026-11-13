@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            @include('auth.partials.illustration', ['cols' => 'lg-6'])
                            <div class="col-lg-6">
                                <div class="p-5">
                                    @if (session('status'))
                                        <div class="alert alert-success small" role="alert">{{ session('status') }}</div>
                                    @endif

                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                placeholder="Alamat Email" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback ml-3" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                        <input type="password" id="password" name="password" placeholder="Kata Sandi"
                                            class="form-control form-control-user @error('password') is-invalid @enderror" required autocomplete="current-password">
                                        @error('password')
                                            <span class="invalid-feedback ml-3" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="customCheck">Ingat Saya</label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Masuk</button>
                                    </form>
                                    <hr>
                                    @if (Route::has('password.request'))
                                        <div class="text-center">
                                            <a class="small" href="{{ route('password.request') }}">Lupa Kata Sandi?</a>
                                        </div>
                                    @endif
                                    @if (Route::has('register'))
                                        <div class="text-center">
                                            <a class="small" href="{{ route('register') }}">Buat Akun Baru!</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
