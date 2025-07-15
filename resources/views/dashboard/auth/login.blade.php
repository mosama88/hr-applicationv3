@extends('dashboard.auth.layouts.master')
@section('title', 'صفحة تسجيل الدخول')
@section('content')
    @include('dashboard.layouts.message')


    <form action="{{ route('login.store') }}" method="POST" id="loginForm">
        @csrf
        <div class="input-group mb-1">
            <span class="input-group-text"><i class="bi bi-envelope"></i></span>
            <div class="form-floating flex-grow-1">
                <input id="loginEmail" type="text" name="username"
                    class="form-control  @error('username') is-invalid @enderror" placeholder="أسم المستخدم" />
                <label for="loginEmail">أسم المستخدم</label>
            </div>
        </div>
        @error('username')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror

        <div class="input-group mb-1">
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
            <div class="form-floating flex-grow-1">
                <input id="loginEmail" type="password" name="password"
                    class="form-control @error('password') is-invalid @enderror" placeholder="**************" />
                <label for="loginEmail">كلمة المرور</label>
            </div>
        </div>
        @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror

        <div class="row">
            <div class="col-12 d-inline-flex align-items-center" dir="rtl">
                <div class="form-check">
                    <label class="form-check-label text-right" for="flexCheckDefault"> تذكرنى </label>
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                </div>
            </div>
            <div class="col-8 mx-auto mt-2">
                <div class="d-grid gap-2">
                    <button type="submit" id="submitButton" style="background-color: #065084;color:#91C8E4"
                        class="btn">تسجيل
                        الدخول</button>
                </div>
            </div>
        </div>
    </form>


@endsection
