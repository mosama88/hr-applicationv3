{{-- <!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="rtl" data-theme="theme-default"
    data-assets-path="{{ asset('dashboard') }}/assets/assets/" data-template="vertical-menu-template">

<head>
    @include('dashboard.auth.layouts.css')
</head>

<body>
    <!-- Content -->




    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-6">
                <!-- Login -->
                <div class="card">
                    <div class="card-body">
                        <!-- Logo -->
                        <div class="app-brand justify-content-center mb-6">
                            <a href="index.html" class="app-brand-link">
                                <span class="app-brand-logo demo">
                                    <span class="text-primary">
                                        <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                                fill="currentColor" />
                                            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                                fill="#161616" />
                                            <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                                d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                                fill="#161616" />
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </span>
                                <span class="app-brand-text demo text-heading fw-bold">Vuexy</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-1">Welcome to Vuexy! 👋</h4>
                        <p class="mb-6">Please sign-in to your account and start the adventure</p>

                        @yield('content')

                        <p class="text-center">
                            <span>New on our platform?</span>
                            <a href="auth-register-basic.html">
                                <span>Create an account</span>
                            </a>
                        </p>

                        <div class="divider my-6">
                            <div class="divider-text">or</div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-facebook me-1_5">
                                <i class="icon-base ti tabler-brand-facebook-filled icon-20px"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-twitter me-1_5">
                                <i class="icon-base ti tabler-brand-twitter-filled icon-20px"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-github me-1_5">
                                <i class="icon-base ti tabler-brand-github-filled icon-20px"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-icon rounded-circle btn-text-google-plus">
                                <i class="icon-base ti tabler-brand-google-filled icon-20px"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /Login -->
            </div>
        </div>
    </div>



    <!-- Core JS -->
    @include('dashboard.auth.layouts.js')
</body>

</html>
<!doctype html>

<html lang="en" class="layout-wide customizer-hide" dir="ltr" data-skin="default"
    data-assets-path="{{ asset('dashboard') }}/assets/assets/" data-template="vertical-menu-template" data-bs-theme="light">

<head>

</head>

<body>
    <!-- Content -->


    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/theme.js -->

</body>

</html>
 --}}


<!DOCTYPE html>
<html lang="en">

<head>
    @include('dashboard.auth.layouts.css')

</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="{{ asset('dashboard') }}/assets/index2.html"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">قم بتسجيل الدخول لبدء جلستك</p>

                @yield('content')

                <div class="social-auth-links text-center mb-3">
                    <p>- أو التواصل مع الدعم الفنى -</p>

                </div>
                <!-- /.social-auth-links -->


            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->
    @include('dashboard.auth.layouts.js')


</body>

</html>
