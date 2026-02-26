@extends('layouts.app')

@section('title')
    Home
@endsection

@section('content')
    <section class="section-login">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card shadow" style="color: #1E3771">
                        <div class="logo-login text-center mt-5">
                            <img src="{{ asset('frontend/image/logo.png') }}" alt="" class="justify-content-center">
                        </div>
                        <div class="card-body">
                            <form action="{{ route('login.store') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label for="nomor_induk" class="form-label">NPM</label>
                                    <input type="text" name="nomor_induk" id="nomor_induk" class="form-control">
                                    @error('nomor_induk')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                    @error('password')
                                        <span class="text-danger mt-2">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <button type="submit" class="btn btn-login-submit">Login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
