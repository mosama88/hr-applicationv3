<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    @include('dashboard.auth.layouts.css')
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="javascript:void(0)" class="h1"><b>HR</b>System</b>Management</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">قم بتسجيل الدخول لبدء جلستك</p>
                @yield('content')

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    @include('dashboard.auth.layouts.js')
</body>

</html>
