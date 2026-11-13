@extends('layouts.app')

@section('title', 'Reset Kata Sandi')

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
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Atur Ulang Kata Sandi</h1>
                                    </div>
                                    <form class="user" method="POST" action="{{ route('password.update') }}">
                                        @csrf
                                        <input type="hidden" name="token" value="{{ $token }}">
                                        <div class="form-group">
                                            <input type="email" id="email" name="email" value="{{ $email ?? old('email') }}"
                                                class="form-control form-control-user @error('email') is-invalid @enderror"
                                                placeholder="Alamat Email" required autocomplete="email" autofocus>
                                            @error('email')
                                                <span class="invalid-feedback ml-3" role="alert"><strong>{{ $message }}</strong></span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                        <input type="password" id="password" name="password" placeholder="Kata Sandi Baru"
                                            class="form-control form-control-user @error('password') is-invalid @enderror" required autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback ml-3" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                    </div>
                                        <div class="form-group">
                                            <input type="password" id="password-confirm" name="password_confirmation"
                                                class="form-control form-control-user" placeholder="Ulangi Kata Sandi Baru"
                                                required autocomplete="new-password">
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Atur Ulang Kata Sandi</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
