<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    @include('dashboard.auth.layouts.css')

</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary">
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <div class="text-center">
                    <h2 class="mb-0" style="text-decoration: none;"><b>مستشفى </b>الرحمه</h2>
                    <h4 class="mb-0" style="text-decoration: none;"><b>إدارة </b>الموارد البشرية</h4>
                </div>


            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">قم بتسجيل الدخول لبدء جلستك</p>
                @yield('content')

                <div class="social-auth-links text-center mb-3 d-grid gap-2">
                    <p>- أو -</p>
                    <span class="btn btn-info text-white">
                        <i class="bi bi-facebook me-2"></i> الاتصال بالدعم الفنى
                    </span>

                </div>
                <!-- /.social-auth-links -->
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    @include('dashboard.auth.layouts.js')

    <!--end::OverlayScrollbars Configure-->
    <!--end::Script-->
</body>
<!--end::Body-->

</html>
