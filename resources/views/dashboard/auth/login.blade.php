@extends('dashboard.auth.layouts.master')
@section('title', 'صفحة تسجيل الدخول')
@section('content')
    @include('dashboard.layouts.message')


    <form action="{{ route('login.store') }}" method="POST" id="loginForm">
        @csrf
        <div class="input-group mb-3">
            <input type="text" name="username" class="form-control @error('username') is-invalid @enderror"
                placeholder="أسم المستخدم">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
            @error('username')
                <span class="invalid-feedback text-right" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="**********">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
            @error('password')
                <span class="invalid-feedback text-right" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <input type="checkbox" id="remember">
                    <label for="remember">
                        تذكرنى
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" id="submitButton" class="btn btn-primary btn-block">تسجيل الدخول</button>
            </div>
            <!-- /.col -->
        </div>
    </form>

@endsection
