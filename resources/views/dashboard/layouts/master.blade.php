<!doctype html>
<html lang="en" dir="rtl">
<!--begin::Head-->

<head>

    <!--end::Required Plugin(AdminLTE)-->
    @include('dashboard.layouts.head')

</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary app-loaded sidebar-open">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">

        <!--begin::Header-->
        @include('dashboard.layouts.navbar')
        <!--end::Header-->
        <!--begin::Sidebar-->
        @include('dashboard.layouts.sidebar')

        <!--end::Sidebar-->
        <!--begin::App Main-->


        <main class="app-main">

        


            @yield('content')
            <!--end::App Main-->
            <!--begin::Footer-->

        </main>




        @include('dashboard.layouts.footer')



        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->


    @include('dashboard.layouts.scripts')



    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- apexcharts -->



    <!--end::Script-->
</body>
<!--end::Body-->

</html>
