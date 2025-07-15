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

<body style="background-color: #316681;"> <!-- أسود أنيق بدل black -->

    <div class="login-page"
        style="
           background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('dashboard/assets/dist/assets/img/hr-system.jpg') }}');
           background-repeat: no-repeat;
           background-position: center center;
           background-attachment: fixed;
           background-size: contain;
           min-height: 100vh;
           display: flex;
           align-items: center;
           justify-content: center;
        ">

        <div class="login-box">
            <div class="card card-outline text-secondary card-primary"
                style="background-color: rgba(255, 255, 255, 0.8); box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);">
                <div class="card-header text-center">
                    <h2 class="mb-0"><b>مستشفى </b>الرحمه</h2>
                    <h4 class="mb-0"><b>إدارة </b>الموارد البشرية</h4>
                </div>
                <div class="card-body login-card-body">
                    <p class="login-box-msg">قم بتسجيل الدخول لبدء جلستك</p>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    @include('dashboard.auth.layouts.js')
</body>

<!--end::Body-->

</html>
