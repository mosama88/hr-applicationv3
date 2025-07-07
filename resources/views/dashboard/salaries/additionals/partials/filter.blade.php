@php
    use App\Models\MainSalaryEmployee;
    use App\Enums\Salaries\SanctionTypeEnum;
@endphp
@push('css')
@endpush

@if ($errors->any())
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger text-center">
            {{ $error }}
        </div>
    @endforeach
@endif


<div class="card card-secondary">
    <div class="card-header">
        <h3 class="card-title">
            <p class="">
                يمكنك استخدام الفلاتر التالية للبحث عن الموظفين حسب كود الموظف أو اسم
                الموظف أو عدد أيام الاضافى.......
            </p>
        </h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="mb-3 d-flex gap-2">

            <a class="btn btn-success" href="{{ route('dashboard.additionals.export', $financeClnPeriod->slug) }}">
                <i class="fas fa-arrow-alt-circle-down ml-2"></i> تحميل اكسيل شيت
            </a>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#importExcel">
                <i class="fas fa-arrow-alt-circle-up ml-2"></i> إستيراد إكسيل
            </button>

            @include('dashboard.salaries.additionals.partials.import')

            <form id="printForm" action="{{ route('dashboard.additionals.print') }}" method="POST" target="_blank">
                @csrf
                <input type="hidden" name="employee_code_search" value="{{ request('employee_code_search') }}">
                <input type="hidden" name="name" value="{{ request('name') }}">
                <input type="hidden" name="days_additional" value="{{ request('days_additional') }}">

                <button type="submit" class="btn" style="background-color: #4d4d4e; color: white;">
                    <i class="fa-solid fa-print ml-2"></i> طباعة حسب البحث
                </button>
            </form>

        </div>


        <form action="{{ route('dashboard.additionals.show', $financeClnPeriod->slug) }}" method="GET">
            <div class="row">

                <!-- كود الموظف -->
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="employee_code-input">كود
                        الموظف</label>
                    <input type="text" class="form-control" name="employee_code_search"
                        value="{{ request('employee_code_search') }}" id="employee_code-input"
                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');" placeholder="مثال:1000" />
                </div>

                <!--  أسم الموظف  -->
                <div class="col-md-4 mb-3">
                    <label class="form-label" for="name-input">أسم الموظف</label>
                    <input type="text" class="form-control" name="name" value="{{ request('name') }}"
                        id="name-input" placeholder="مثال:احمد" />
                </div>


                <!-- عدد أيام الجزاء -->
                <div class="col-md-2 mb-3">
                    <label class="form-label" for="value-input">
                        عدد أيام الغياب</label>
                    <input type="text" name="days_additionals" class="form-control"
                        oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="{{ request('days_additionals') }}"
                        id="value-input">
                </div>
            </div>
            @include('dashboard.partials.filter-actions')
        </form>
    </div>
    <!-- /.card-body -->
</div>
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // نسخ بيانات البحث من الفورم الرئيسي إلى فورم الطباعة
            const mainForm = document.querySelector('form[method="GET"]');
            const printForm = document.getElementById('printForm');

            if (mainForm && printForm) {
                mainForm.querySelectorAll('input, select').forEach(input => {
                    const hiddenInput = printForm.querySelector(`input[name="${input.name}"]`);
                    if (hiddenInput) {
                        hiddenInput.value = input.value;
                    }
                });
            }
        });
    </script>
@endpush
