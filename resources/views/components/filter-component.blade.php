<div class="accordion mb-3" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <i class="fa-solid fa-filter mx-1"></i>تصفية واستيراد وتصدير البيانات
            </button>
        </h2>
        <div id="collapseOne"
            class="accordion-collapse collapse {{ request('employee_code_search') ||
            request('name') ||
            request('department') ||
            request('branch') ||
            request($otherInput) ||
            ($otherInputTwo ? request($otherInputTwo) : false)
                ? 'show'
                : '' }}"
            data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <strong>( يمكنك استخدام الفلاتر التالية للبحث
                    عن الموظفين حسب كود الموظف أو اسم الموظف والفرع والادارة.......)
                </strong>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
