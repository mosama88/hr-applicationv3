<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    @include('dashboard.auth.layouts.css')
    <style>
        .login-box {
            max-width: 400px;
            margin: 5% auto;
            background-color: rgba(255, 255, 255, 0.9);
            /* خلفية شبه شفافة */
            padding: 20px;
            border-radius: 10px;
        }

        @media (max-width: 768px) {
            .login-box {
                margin: 20px auto;
                width: 90%;
            }
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="login-page bg-body-secondary"
    style="background: url('{{ asset('dashboard/assets/dist/assets/img/hospitalrahma.png') }}') no-repeat center center fixed;
           background-size: cover;
           background-position: center;
           background-repeat: no-repeat;
           background-attachment: fixed;">
    <div class="login-box">
        <div class="card card-outline text-secondary card-primary" style="background-color: rgba(255, 255, 255, 0.7);">
            <div class="card-header">
                <div class="text-center">
                    <h2 class="mb-0" style="text-decoration: none;"><b>مستشفى </b>الرحمه</h2>
                    <h4 class="mb-0" style="text-decoration: none;"><b>إدارة </b>الموارد البشرية</h4>
                </div>
            </div>
            <div class="card-body login-card-body">
                <p class="login-box-msg">قم بتسجيل الدخول لبدء جلستك</p>
                @yield('content')

            </div>
        </div>
    </div>
    @include('dashboard.auth.layouts.js')
</body>
<!--end::Body-->

</html>
