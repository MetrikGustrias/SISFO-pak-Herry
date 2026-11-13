@extends('layouts.app')

@section('title', 'Lupa Kata Sandi')

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
                                        <h1 class="h4 text-gray-900 mb-2">Lupa Kata Sandi?</h1>
                                        <p class="mb-4">Masukkan alamat email Anda dan kami akan mengirim tautan untuk mengatur ulang kata sandi.</p>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                placeholder="Alamat Email" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback ml-3" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Kirim Tautan Reset</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('register') }}">Buat Akun Baru!</a>
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
