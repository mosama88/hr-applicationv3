<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>مستشفى الرحمة | صفحة الدخول</title>
<!--begin::Primary Meta Tags-->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="title" content="AdminLTE 4 | Login Page v2" />
<meta name="author" content="ColorlibHQ" />
<meta name="description" content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
<meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
<!--end::Primary Meta Tags-->
<!--begin::Fonts-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
<!--end::Fonts-->
<!--begin::Third Party Plugin(OverlayScrollbars)-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
<!--end::Third Party Plugin(OverlayScrollbars)-->
<!--begin::Third Party Plugin(Bootstrap Icons)-->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
<!--end::Third Party Plugin(Bootstrap Icons)-->
<!--begin::Required Plugin(AdminLTE)-->
<link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/adminlte.css" />
<!--end::Required Plugin(AdminLTE)-->



<style>
    body {
        background: url('{{ asset('dashboard') }}/assets/dist/assets/img/hr.jpg') no-repeat center center fixed;
        background-size: cover;
        position: relative;
    }

    /* طبقة شفافة فوق الخلفية لتسهيل قراءة النص */
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.7);
        z-index: -1;
    }

    .login-box {
        width: 600px !important;
        margin: 50px auto;
    }

    .login-box .card {
        padding: 20px;
        min-height: 400px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        border-radius: 10px;
        backdrop-filter: blur(5px);
        background-color: rgba(255, 255, 255, 0.9);

        /* obacity card */
        background-color: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
    }

    .card-header {
        background-color: transparent !important;
        border-bottom: 1px solid #dee2e6;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        border-color: #0056b3;
        transform: translateY(-2px);
    }

    .input-group-text {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
    }

    .form-control:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* تحسينات للشاشات الصغيرة */
    @media (max-width: 576px) {
        .login-box {
            width: 90% !important;
            margin: 20px auto;
        }
    }
</style>
