document.addEventListener("DOMContentLoaded", function () {
    flatpickr(".date-picker", {
        locale: "ar", // تفعيل اللغة العربية
        dateFormat: "Y-m-d", // صيغة التاريخ
        allowInput: true, // السماح بالإدخال اليدوي
        altInput: true, // عرض بديل للتاريخ
        altFormat: "j F Y", // صيغة العرض: 15 أكتوبر 2023
        minDate: "today", // لا تسمح بتواريخ قبل اليوم
        disableMobile: true, // تعطيل المحرك الافتراضي على الموبايل
        nextArrow: '<i class="fa fa-angle-right"></i>',
        prevArrow: '<i class="fa fa-angle-left"></i>'
    });
    const startDate = flatpickr(".date-input", {
        onChange: function (selectedDates) {
            endDate.set("minDate", selectedDates[0]);
        }
    });

    const endDate = flatpickr(".date_id-input", {});
});
$(document).ready(function () {
    $('.clear-date-btn').on('click', function () {
        let targetInput = $(this).data('target');
        $(targetInput).val('');
    });
});