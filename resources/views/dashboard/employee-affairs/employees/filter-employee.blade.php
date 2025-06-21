@php
    use App\Enums\AdminGenderEnum;
    use App\Enums\StatusActiveEnum;
@endphp

@extends('dashboard.layouts.master')
@section('active-employees', 'active')
@section('title', 'شاشة بحث الموظفين')
@push('css')
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard') }}/assets/dist/css/select2-style.css" />
    <style>
        /* تنسيق عام لعارض السيرة الذاتية */
        .cv-container {
            position: relative;
            min-height: 40px;
            text-align: center;
        }

        /* تنسيق معاينة PDF */
        .pdf-preview {
            display: inline-block;
            position: relative;
        }

        .pdf-icon {
            font-size: 30px;
            color: #e74c3c;
            transition: all 0.3s ease;
        }

        /* تنسيق أدوات التلميح */
        .pdf-tooltip,
        .img-tooltip {
            position: absolute;
            bottom: 100%;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            white-space: nowrap;
            visibility: hidden;
            opacity: 0;
            transition: opacity 0.3s;
            z-index: 100;
        }

        /* إظهار الأدوات عند Hover */
        .pdf-icon-wrapper:hover .pdf-tooltip,
        .img-preview:hover .img-tooltip {
            visibility: visible;
            opacity: 1;
        }

        /* تنسيق الصورة */
        .img-preview {
            position: relative;
            display: inline-block;
        }

        .img-thumbnail {
            max-width: 70px;
            max-height: 70px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .no-cv {
            color: #999;
            font-style: italic;
            font-size: 12px;
        }
    </style>
@endpush
@section('content')

    @include('dashboard.layouts.message')
    <!-- Content Header (Page header) -->


    @include('dashboard.layouts.breadcrumbs', [
        'titlePage' => 'فلتر شاشة الموظفين',
        'previousPage' => 'جدول الموظفين',
        'currentPage' => 'فلتر شاشة الموظفين',
        'url' => 'employees.index',
    ])


    <section class="content">
        <div class="container-fluid">
            @include('dashboard.employee-affairs.employees.partials.filter')

        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>صورة الموظف</th>
                        <th>كود الموظف</th>
                        <th>الأسم</th>
                        <th>الفرع</th>
                        <th>الوظيفه</th>
                        <th>الموبايل</th>
                        <th>الحالة</th>
                        <th>السيرة الذاتية</th>
                        <th>الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($data as $info)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                @if ($info->getFirstMediaUrl('photo', 'preview'))
                                    <img class="img-thumbnail" src="{{ $info->getFirstMediaUrl('photo', 'preview') }}"
                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                @elseif($info->gender === AdminGenderEnum::Male)
                                    <img class="img-thumbnail"
                                        src="{{ asset('dashboard') }}/assets/dist/assets/img/employees-male-default.png"
                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                @elseif($info->gender === AdminGenderEnum::Female)
                                    <img class="img-thumbnail"
                                        src="{{ asset('dashboard') }}/assets/dist/assets/img/employees-female-default.png"
                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                @else
                                    <img class="img-thumbnail" src="{{ asset('dashboard') }}/assets/img/Employee.png"
                                        style="max-width: 70px;max-height: 70px;" alt="{{ $info->name }}">
                                @endif
                            </td>
                            <td>{{ $info->employee_code }}</td>
                            <td>{{ $info->name }}</td>
                            <td>{{ $info->branch?->name }}</td>
                            <td>{{ $info->jobCategory?->name }}</td>
                            <td>{{ $info->mobile }}</td>
                            <td>
                                @if ($info->active == StatusActiveEnum::ACTIVE)
                                    <span class="badge bg-success">مفعل</span>
                                @else
                                    <span class="badge bg-danger">غير مفعل</span>
                                @endif
                            </td>
                            <td style="max-width: 30px; max-height: 70px;">
                                <div class="cv-container">
                                    @if ($info->getFirstMediaUrl('cv'))
                                        @if (Str::endsWith($info->getFirstMediaUrl('cv'), ['.pdf', '.PDF']))
                                            <!-- عرض أيقونة PDF مع اسم ملف يظهر عند Hover -->
                                            <div class="pdf-preview">
                                                <a href="{{ $info->getFirstMediaUrl('cv') }}" target="_blank"
                                                    class="pdf-link">
                                                    <div class="pdf-icon-wrapper">
                                                        <i class="fas fa-file-pdf pdf-icon"></i>
                                                        <span
                                                            class="pdf-tooltip">{{ basename($info->getFirstMediaUrl('cv')) }}</span>
                                                    </div>
                                                </a>
                                            </div>
                                        @else
                                            <!-- عرض الصورة مع اسم ملف يظهر عند Hover -->
                                            <div class="img-preview">
                                                <img class="img-thumbnail" src="{{ $info->getFirstMediaUrl('cv') }}"
                                                    style="max-width: 70px; max-height: 70px;" alt="{{ $info->name }}">
                                                <span
                                                    class="img-tooltip">{{ basename($info->getFirstMediaUrl('cv')) }}</span>
                                            </div>
                                        @endif
                                    @else
                                        <span class="no-cv">لا يوجد سيرة ذاتية</span>
                                    @endif
                                </div>
                            </td>

                            <td>
                                @include('dashboard.partials.actions', [
                                    'name' => 'employees',
                                    'name_id' => $info->slug,
                                ])
                            </td>
                        </tr>
                    @empty
                        <div class="alert alert-secondary" role="alert">عفوآ لا توجد بيانات!</div>
                    @endforelse
                </tbody>
            </table>
            <div class="row">
                <div class="col-12 my-2">
                    {{ $data->appends(request()->query())->links() }}

                </div>
            </div>
        </div>
        </div>

        </div>
        <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
        </div>
    </section>


@endsection
@push('js')
    <script src="{{ asset('dashboard') }}/assets/dist/js/select2.min.js"></script>
    <!-- مكتبة Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <!-- ملف اللغة العربية -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/ar.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>


    <script>
        function resetFilters() {
            window.location.href = window.location.pathname;
        }
    </script>

    <script>
        $(document).ready(function() {
            // country_select2
            $('.country_select2').select2({
                placeholder: '-- أختر الدولة --',
                ajax: {
                    url: "{{ route('dashboard.countries.searchCountry') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(countries => ({
                                id: countries.id,
                                text: `${countries.name} ➜ (${countries.country_code})`
                            }))
                        };
                    }
                }
            });

            $('.city_select2').select2({
                placeholder: '-- أختر المدينه --',
                ajax: {
                    url: "{{ route('dashboard.cities.searchCity') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(cities => ({
                                id: cities.id,
                                text: `${cities.name}`
                            }))
                        };
                    }
                }
            });


            // currency_select2
            $('.currency_select2').select2({
                placeholder: '-- أختر العملة --',
                ajax: {
                    url: "{{ route('dashboard.currencies.searchCurrency') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(currencies => ({
                                id: currencies.id,
                                text: `${currencies.name} ➜ (${currencies.currency_symbol})`
                            }))
                        };
                    }
                }
            });

            // nationality_select2
            $('.nationality_select2').select2({
                placeholder: '-- أختر الجنسية --',
                ajax: {
                    url: "{{ route('dashboard.nationalities.searchNationality') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(nationalities => ({
                                id: nationalities.id,
                                text: `${nationalities.name}`
                            }))
                        };
                    }
                }
            });



            // language_select2
            $('.language_select2').select2({
                placeholder: '-- أختر اللغه --',
                ajax: {
                    url: "{{ route('dashboard.languages.searchlanguage') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(languages => ({
                                id: languages.id,
                                text: `${languages.name}`
                            }))
                        };
                    }
                }
            });


            // qualification_select2
            $('.qualification_select2').select2({
                placeholder: '-- أختر المؤهل --',
                ajax: {
                    url: "{{ route('dashboard.qualifications.searchQualification') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(qualifications => ({
                                id: qualifications.id,
                                text: `${qualifications.name}`
                            }))
                        };
                    }
                }
            });
            // department_select2
            $('.department_select2').select2({
                placeholder: '-- أختر الادارة --',
                ajax: {
                    url: "{{ route('dashboard.departments.searchDepartment') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(departments => ({
                                id: departments.id,
                                text: `${departments.name}`
                            }))
                        };
                    }
                }
            });


            // job_category_select2
            $('.job_category_select2').select2({
                placeholder: '-- أختر الوظيفه --',
                ajax: {
                    url: "{{ route('dashboard.job_categories.searchJob_category') }}",
                    dataType: 'json',
                    delay: 250, // Delay for better UX
                    data: function(params) {
                        return {
                            q: params.term // Search query
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data.data.map(jobCategories => ({
                                id: jobCategories.id,
                                text: `${jobCategories.name}`
                            }))
                        };
                    }
                }
            });
        });
    </script>
@endpush
