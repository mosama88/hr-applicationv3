    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')| مستشفى الرحمة</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="مستشفى الرحمة | @yield('title')" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
    <!--end::Primary Meta Tags-->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/fonts/stylesheet.css" />

    <!--arabic font-->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/fonts/stylesheet.css" />


    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/index.css">

    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/overlayscrollbars.min.css">

    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/adminlte.rtl.css" />

    <!--arabic font-->
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/style.css" />
    @stack('css')
    <style>
        .select2-container--default .select2-selection--single {
            height: 35px;
            /* لتحديد ارتفاع الحقل */
            line-height: 30px;
            /* لضبط النص في المنتصف */
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
            /* لضبط السهم */
        }
    </style>
    <style>
        .navbar .nav-link {
            color: #91C8E4 !important;
        }
    </style>
