@php
    use App\Models\MainSalaryEmployee;
    use App\Enums\Salaries\SanctionTypeEnum;
@endphp
@push('css')
@endpush


<!-- فلتر -->
<x-filter-component :otherInput="'days_absences'">
    <div class="mb-3 d-flex gap-2 mt-2">

        <form action="{{ route('dashboard.absences.export', $financeClnPeriod->slug) }}" method="GET">
            @csrf
            <button type="submit" class="btn" style="background-color: #273F4F; color: #fff;"> <i
                    class="fas fa-arrow-alt-circle-down ml-2"></i> تحميل اكسيل شيت</button>
            <div class="d-none">
                <input type="hidden" name="employee_code_search" value="{{ request('employee_code_search') }}">
                <input type="hidden" name="name" value="{{ request('name') }}">
                <input type="hidden" name="department" value="{{ request('department') }}">
                <input type="hidden" name="branch" value="{{ request('branch') }}">
                <input type="hidden" name="days_absences" value="{{ request('days_absences') }}">
            </div>
        </form>


        @include('dashboard.partials.import', [
            'title' => 'الغيابات',
            'financeClnPeriod' => $financeClnPeriod->slug,
            'url' => 'absences',
            'columns' => 'الأسم وكود الموظف وعدد الأيام والأجمالى والملاحظات',
        ])

        <form id="printForm" action="{{ route('dashboard.absences.print') }}" method="POST" target="_blank">
            @csrf
            <input type="hidden" name="employee_code_search" value="{{ request('employee_code_search') }}">
            <input type="hidden" name="name" value="{{ request('name') }}">
            <input type="hidden" name="department" value="{{ request('department') }}">
            <input type="hidden" name="branch" value="{{ request('branch') }}">
            <input type="hidden" name="days_absences" value="{{ request('days_absences') }}">

            <button type="submit" class="btn" style="background-color: #4d4d4e; color: white;">
                <i class="fa-solid fa-print ml-2"></i> طباعة حسب البحث
            </button>
        </form>

    </div>

    <form action="{{ route('dashboard.absences.show', $financeClnPeriod->slug) }}" method="GET">
        <div class="row">

            <!-- كود الموظف -->
            <div class="col-md-3 mb-3">
                <label class="form-label" for="employee_code-input">كود
                    الموظف</label>
                <input type="text" class="form-control" name="employee_code_search"
                    value="{{ request('employee_code_search') }}" id="employee_code-input"
                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');" placeholder="مثال:1000" />
            </div>

            <!--  أسم الموظف  -->
            <div class="col-md-3 mb-3">
                <label class="form-label" for="name-input">أسم الموظف</label>
                <input type="text" class="form-control" name="name" value="{{ request('name') }}" id="name-input"
                    placeholder="مثال:احمد" />
            </div>
            <!--  إدارة الموظف  -->
            <div class="col-md-3 mb-3">
                <label class="form-label" for="department-input">الادارة</label>
                <input type="text" class="form-control" name="department" value="{{ request('department') }}"
                    id="name-input" placeholder="مثال:إدارة الشؤون القانونية " />
            </div>

            <!--  فرع الموظف  -->
            <div class="col-md-3 mb-3">
                <label class="form-label" for="branch-input">الفرع</label>
                <input type="text" class="form-control" name="branch" value="{{ request('branch') }}"
                    id="name-input" placeholder="مثال:فرع المهندسين	 " />
            </div>


            <!-- عدد أيام الغياب -->
            <div class="col-md-2 mb-3">
                <label class="form-label" for="value-input">
                    عدد أيام الغياب</label>
                <input type="text" name="days_absences" class="form-control"
                    oninput="this.value=this.value.replace(/[^0-9.]/g,'');" value="{{ request('days_absences') }}"
                    id="value-input">
            </div>
        </div>
        @include('dashboard.partials.filter-actions')
    </form>
</x-filter-component>


<!-- /.card-body -->

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
