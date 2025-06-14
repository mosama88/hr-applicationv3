  <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="./index.html" class="brand-link">
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
              <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">



                  <li class="nav-item">
                      <a href="{{ route('dashboard.index') }}" class="nav-link active">
                          <i class="nav-icon bi bi-speedometer"></i>
                          <p>
                              لوحة التحكم
                          </p>
                      </a>
                  </li>
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
                          ? 'open active'
                          : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-box-seam-fill"></i>
                          <p>
                              الأعدادت
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item @yield('active-admin_panel_settings')">
                              <a href="{{ route('dashboard.admin_panel_settings.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>إعدادت الشركة</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-financeCalendars')">
                              <a href="{{ route('dashboard.financeCalendars.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>السنوات المالية</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-shiftTypes')">
                              <a href="{{ route('dashboard.shiftTypes.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>مواعيد الشفتات</p>
                              </a>
                          </li>



                          <li class="nav-item @yield('active-branches')">
                              <a href="{{ route('dashboard.branches.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>الفروع</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-currencies')">
                              <a href="{{ route('dashboard.currencies.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>العملات</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-departments')">
                              <a href="{{ route('dashboard.departments.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>الادارات</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-job_categories')">
                              <a href="{{ route('dashboard.job_categories.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>الوظائف</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-qualifications')">
                              <a href="{{ route('dashboard.qualifications.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>المؤهلات</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-bloodTypes')">
                              <a href="{{ route('dashboard.bloodTypes.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>فصيلة الدم</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-nationalities')">
                              <a href="{{ route('dashboard.nationalities.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>الجنسيات</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-languages')">
                              <a href="{{ route('dashboard.languages.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>اللغات</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-countries')">
                              <a href="{{ route('dashboard.countries.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>الدول</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-governorates')">
                              <a href="{{ route('dashboard.governorates.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>المحافظات</p>
                              </a>
                          </li>

                          <li class="nav-item @yield('active-cities')">
                              <a href="{{ route('dashboard.cities.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>المدن</p>
                              </a>
                          </li>


                          <li class="nav-item @yield('active-job_grades')">
                              <a href="{{ route('dashboard.job_grades.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>الدرجات الوظيفية</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li
                      class="nav-item {{ request()->is('dashboard/additional_types*') ||
                      request()->is('dashboard/allowances*') ||
                      request()->is('dashboard/discount_types*') ||
                      request()->is('dashboard/employees*')
                          ? 'open active'
                          : '' }}">
                      <a href="#" class="nav-link">
                          <i class="nav-icon fa-solid fa-users"></i>
                          <p>
                              شئون الموظفين
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item @yield('active-employees')">
                              <a href="{{ route('dashboard.employees.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>بيانات الموظفين</p>
                              </a>
                          </li>


                          <li class="nav-item @yield('active-additional_types')">
                              <a href="{{ route('dashboard.additional_types.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>أنواع الأضافى</p>
                              </a>
                          </li>



                          <li class="nav-item @yield('active-allowances')">
                              <a href="{{ route('dashboard.allowances.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>أنواع البدلات</p>
                              </a>
                          </li>



                          <li class="nav-item @yield('active-discount_types')">
                              <a href="{{ route('dashboard.discount_types.index') }}" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>أنواع الخصومات</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-tree-fill"></i>
                          <p>
                              UI Elements
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="./UI/general.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>General</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="./UI/icons.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Icons</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="./UI/timeline.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Timeline</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-pencil-square"></i>
                          <p>
                              Forms
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="./forms/general.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>General Elements</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-table"></i>
                          <p>
                              Tables
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="./tables/simple.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Simple Tables</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-header">EXAMPLES</li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-box-arrow-in-right"></i>
                          <p>
                              Auth
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                  <p>
                                      Version 1
                                      <i class="nav-arrow bi bi-chevron-right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="./examples/login.html" class="nav-link">
                                          <i class="nav-icon bi bi-circle"></i>
                                          <p>Login</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="./examples/register.html" class="nav-link">
                                          <i class="nav-icon bi bi-circle"></i>
                                          <p>Register</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-box-arrow-in-right"></i>
                                  <p>
                                      Version 2
                                      <i class="nav-arrow bi bi-chevron-right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="./examples/login-v2.html" class="nav-link">
                                          <i class="nav-icon bi bi-circle"></i>
                                          <p>Login</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="./examples/register-v2.html" class="nav-link">
                                          <i class="nav-icon bi bi-circle"></i>
                                          <p>Register</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="./examples/lockscreen.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Lockscreen</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-header">DOCUMENTATIONS</li>
                  <li class="nav-item">
                      <a href="./docs/introduction.html" class="nav-link">
                          <i class="nav-icon bi bi-download"></i>
                          <p>Installation</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="./docs/layout.html" class="nav-link">
                          <i class="nav-icon bi bi-grip-horizontal"></i>
                          <p>Layout</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="./docs/color-mode.html" class="nav-link">
                          <i class="nav-icon bi bi-star-half"></i>
                          <p>Color Mode</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-ui-checks-grid"></i>
                          <p>
                              Components
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="./docs/components/main-header.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Main Header</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="./docs/components/main-sidebar.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Main Sidebar</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-filetype-js"></i>
                          <p>
                              Javascript
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="./docs/javascript/treeview.html" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Treeview</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="./docs/browser-support.html" class="nav-link">
                          <i class="nav-icon bi bi-browser-edge"></i>
                          <p>Browser Support</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="./docs/how-to-contribute.html" class="nav-link">
                          <i class="nav-icon bi bi-hand-thumbs-up-fill"></i>
                          <p>How To Contribute</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="./docs/faq.html" class="nav-link">
                          <i class="nav-icon bi bi-question-circle-fill"></i>
                          <p>FAQ</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="./docs/license.html" class="nav-link">
                          <i class="nav-icon bi bi-patch-check-fill"></i>
                          <p>License</p>
                      </a>
                  </li>
                  <li class="nav-header">MULTI LEVEL EXAMPLE</li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle-fill"></i>
                          <p>Level 1</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle-fill"></i>
                          <p>
                              Level 1
                              <i class="nav-arrow bi bi-chevron-right"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Level 2</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>
                                      Level 2
                                      <i class="nav-arrow bi bi-chevron-right"></i>
                                  </p>
                              </a>
                              <ul class="nav nav-treeview">
                                  <li class="nav-item">
                                      <a href="#" class="nav-link">
                                          <i class="nav-icon bi bi-record-circle-fill"></i>
                                          <p>Level 3</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="#" class="nav-link">
                                          <i class="nav-icon bi bi-record-circle-fill"></i>
                                          <p>Level 3</p>
                                      </a>
                                  </li>
                                  <li class="nav-item">
                                      <a href="#" class="nav-link">
                                          <i class="nav-icon bi bi-record-circle-fill"></i>
                                          <p>Level 3</p>
                                      </a>
                                  </li>
                              </ul>
                          </li>
                          <li class="nav-item">
                              <a href="#" class="nav-link">
                                  <i class="nav-icon bi bi-circle"></i>
                                  <p>Level 2</p>
                              </a>
                          </li>
                      </ul>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle-fill"></i>
                          <p>Level 1</p>
                      </a>
                  </li>
                  <li class="nav-header">LABELS</li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle text-danger"></i>
                          <p class="text">Important</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle text-warning"></i>
                          <p>Warning</p>
                      </a>
                  </li>
                  <li class="nav-item">
                      <a href="#" class="nav-link">
                          <i class="nav-icon bi bi-circle text-info"></i>
                          <p>Informational</p>
                      </a>
                  </li>
              </ul>
              <!--end::Sidebar Menu-->
          </nav>
      </div>
      <!--end::Sidebar Wrapper-->
  </aside>
