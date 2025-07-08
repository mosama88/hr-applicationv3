    {{-- <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark"> --}}
    <aside class="app-sidebar shadow text-light" style="background-color: #432a81;color:#DFECFA" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
            <!--begin::Brand Link-->
            <a href="{{ route('dashboard.index') }}" class="brand-link">
                <!--begin::Brand Image-->
                <img src="{{ asset('dashboard') }}/assets/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
                    class="brand-image opacity-75 shadow" />
                <!--end::Brand Image-->
                <!--begin::Brand Text-->
                <span class="brand-text fw-light">AdminLTE 4</span>
                <!--end::Brand Text-->
            </a>
            <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
            <nav class="mt-2">
                <!--begin::Sidebar Menu-->
                <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                    data-accordion="false">


                    <li class="nav-header text-center">برنامج إدارة الموارد البشرية
                        <p class="text-center">مستشفى الرحمة</p>

                    </li>

                    <li class="nav-item">
                        <a href="{{ route('dashboard.index') }}" class="nav-link  @yield('active-dashboard')">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>
                                لوحة التحكم
                            </p>
                        </a>
                    </li>

                    <li class="nav-header">قائمة الإعدادات</li>
                    <li
                        class="nav-item {{ request()->is('dashboard/financeCalendars*') ||
                        request()->is('dashboard/admin_panel_settings*') ||
                        request()->is('dashboard/branches*') ||
                        request()->is('dashboard/shiftTypes*') ||
                        request()->is('dashboard/countries*') ||
                        request()->is('dashboard/currencies*') ||
                        request()->is('dashboard/departments*') ||
                        request()->is('dashboard/job_categories*') ||
                        request()->is('dashboard/qualifications*') ||
                        request()->is('dashboard/bloodTypes*') ||
                        request()->is('dashboard/nationalities*') ||
                        request()->is('dashboard/governorates*') ||
                        request()->is('dashboard/cities*') ||
                        request()->is('dashboard/job_grades*') ||
                        request()->is('dashboard/languages*')
                            ? 'menu-open'
                            : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('financeCalendars*') ||
                            request()->is('admin_panel_settings*') ||
                            request()->is('branches*') ||
                            request()->is('shiftTypes*') ||
                            request()->is('countries*') ||
                            request()->is('currencies*') ||
                            request()->is('departments*') ||
                            request()->is('job_categories*') ||
                            request()->is('qualifications*') ||
                            request()->is('bloodTypes*') ||
                            request()->is('nationalities*') ||
                            request()->is('governorates*') ||
                            request()->is('cities*') ||
                            request()->is('job_grades*') ||
                            request()->is('languages*')
                                ? 'active'
                                : '' }}">
                            <i class="nav-icon fa-solid fa-sliders"></i>
                            <p>
                                الأعدادت
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.admin_panel_settings.index') }}"
                                    class="nav-link @yield('active-admin_panel_settings')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>إعدادت الشركة</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.financeCalendars.index') }}"
                                    class="nav-link @yield('active-financeCalendars')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>السنوات المالية</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.shiftTypes.index') }}" class="nav-link @yield('active-shiftTypes')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>مواعيد الشفتات</p>
                                </a>
                            </li>



                            <li class="nav-item">
                                <a href="{{ route('dashboard.branches.index') }}" class="nav-link @yield('active-branches')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>الفروع</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.currencies.index') }}" class="nav-link @yield('active-currencies')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>العملات</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.departments.index') }}" class="nav-link @yield('active-departments')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>الادارات</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.job_categories.index') }}"
                                    class="nav-link @yield('active-job_categories')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>الوظائف</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.qualifications.index') }}"
                                    class="nav-link @yield('active-qualifications')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>المؤهلات</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.bloodTypes.index') }}" class="nav-link @yield('active-bloodTypes')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>فصيلة الدم</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.nationalities.index') }}"
                                    class="nav-link @yield('active-nationalities')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>الجنسيات</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.languages.index') }}" class="nav-link @yield('active-languages')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>اللغات</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.countries.index') }}" class="nav-link @yield('active-countries')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>الدول</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.governorates.index') }}"
                                    class="nav-link @yield('active-governorates')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>المحافظات</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('dashboard.cities.index') }}" class="nav-link @yield('active-cities')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>المدن</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('dashboard.job_grades.index') }}"
                                    class="nav-link @yield('active-job_grades')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>الدرجات الوظيفية</p>
                                </a>
                            </li>
                        </ul>
                    </li>


                    <li class="nav-header">قائمة إدارة شئون الموظفين</li>

                    <li
                        class="nav-item {{ request()->is('dashboard/additional_types*') ||
                        request()->is('dashboard/allowances*') ||
                        request()->is('dashboard/discount_types*') ||
                        request()->is('dashboard/employees*')
                            ? 'menu-open'
                            : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('additional_types*') ||
                            request()->is('allowances*') ||
                            request()->is('discount_types*') ||
                            request()->is('employees*')
                                ? 'active'
                                : '' }}">
                            <i class="nav-icon fa-solid fa-users"></i>
                            <p>
                                شئون الموظفين
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.employees.index') }}" class="nav-link @yield('active-employees')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>بيانات الموظفين</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('dashboard.additional_types.index') }}"
                                    class="nav-link @yield('active-additional_types')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>أنواع الأضافى</p>
                                </a>
                            </li>



                            <li class="nav-item">
                                <a href="{{ route('dashboard.allowances.index') }}"
                                    class="nav-link @yield('active-allowances')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>أنواع البدلات</p>
                                </a>
                            </li>



                            <li class="nav-item">
                                <a href="{{ route('dashboard.discount_types.index') }}"
                                    class="nav-link @yield('active-discount_types')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>أنواع الخصومات</p>
                                </a>
                            </li>
                        </ul>
                    </li>



                    <li class="nav-header">قائمة الاجور</li>

                    <li
                        class="nav-item {{ request()->is('dashboard/main_salary_records*') ||
                        request()->is('dashboard/sanctions*') ||
                        request()->is('dashboard/absences*') ||
                        request()->is('dashboard/employee_salary_allowances*') ||
                        request()->is('dashboard/additionals*')
                            ? 'menu-open'
                            : '' }}">
                        <a href="#"
                            class="nav-link {{ request()->is('main_salary_records*') ||
                            request()->is('sanctions*') ||
                            request()->is('absences*') ||
                            request()->is('employee_salary_allowances*') ||
                            request()->is('additionals*')
                                ? 'active'
                                : '' }}">
                            <i class="nav-icon fa-solid fa-money-check-dollar"></i>
                            <p>
                                رواتب الموظفين
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('dashboard.main_salary_records.index') }}"
                                    class="nav-link @yield('active-main_salary_records')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>السجلات الرئيسية للراوتب</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="{{ route('dashboard.sanctions.index') }}"
                                    class="nav-link @yield('active-sanctions')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>الجزاءات</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.absences.index') }}"
                                    class="nav-link @yield('active-absences')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>غياب أيام</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.additionals.index') }}"
                                    class="nav-link @yield('active-additionals')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>أضافى أيام</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('dashboard.employee_salary_allowances.index') }}"
                                    class="nav-link @yield('active-employee_salary_allowances')">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>البدلات المتغيرة</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>
                <!--end::Sidebar Menu-->
            </nav>
        </div>
        <!--end::Sidebar Wrapper-->
    </aside>
