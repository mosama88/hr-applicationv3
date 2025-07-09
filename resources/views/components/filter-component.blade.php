<div class="accordion mb-3" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                <i class="fa-solid fa-filter mx-1"></i> فلتر و تحميل واستيراد إكسيل
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
            <div class="accordion-body">
                <strong>( يمكنك استخدام الفلاتر التالية للبحث
                    عن الموظفين حسب كود الموظف أو اسم الموظف والفرع والادارة.......)
                </strong>
                {{ $slot }}
            </div>
        </div>
    </div>


</div>
