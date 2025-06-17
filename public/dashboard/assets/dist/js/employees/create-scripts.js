//For Tabs
$(document).ready(function () {
    // منع تحديث الـ URL عند النقر على التبويبات
    $('a[data-toggle="pill"]').on('click', function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
});


// الحالة الأجتماعية
$(document).ready(function () {
    // عند تغيير الحالة الاجتماعية
    $('#social_status').change(function () {
        const selectedStatus = $(this).val();
        // المقارنة بالقيمة الرقمية 1 بدلاً من النص "Single"
        const isSingle = selectedStatus === '1' || selectedStatus === '';

        if (isSingle) {
            // إخفاء حقل عدد الأطفال ومسح القيمة إذا كانت الحالة "أعزب" أو فارغة
            $('#children_number_container').hide();
            $('#children_number').val('');
        } else {
            // إظهار حقل عدد الأطفال إذا كانت الحالة غير "أعزب"
            $('#children_number_container').show();
        }
    });

    // تنفيذ التغيير عند التحميل إذا كانت هناك قيمة مسبقة
    if ($('#social_status').val()) {
        $('#social_status').trigger('change');
    }
});

$(document).ready(function () {
    // عند تغيير حقل "هل يمتلك رخصة قيادة"
    $('#driving_license').change(function () {
        const hasLicense = $(this).val() === '1'; // افترض أن '1' هي قيمة "نعم" في YesOrNoEnum

        if (hasLicense) {
            // إظهار الحقول المرتبطة برخصة القيادة
            $('#license_number_container').show();
            $('#license_type_container').show();
        } else {
            // إخفاء الحقول ومسح قيمها
            $('#license_number_container').hide();
            $('#license_type_container').hide();
            $('#driving_License_id').val('');
            $('#driving_license_type').val('');
        }
    });

    // تنفيذ التغيير عند التحميل إذا كانت هناك قيمة مسبقة
    if ($('#driving_license').val() === '1') {
        $('#driving_license').trigger('change');
    }
});

$(document).ready(function () {
    // التحكم في تفاصيل الأقارب
    $('#has_relatives').change(function () {
        const hasRelatives = $(this).val() === '1'; // 1 = نعم
        if (hasRelatives) {
            $('#relatives_details_container').show();
        } else {
            $('#relatives_details_container').hide();
            $('#relatives_details').val('');
        }
    });

    // التحكم في تفاصيل الإعاقة/العمليات
    $('#has_disabilities').change(function () {
        const hasDisabilities = $(this).val() === '1'; // 1 = نعم
        if (hasDisabilities) {
            $('#disabilities_details_container').show();
        } else {
            $('#disabilities_details_container').hide();
            $('#disabilities_details').val('');
        }
    });

    // تنفيذ التغيير عند التحميل إذا كانت هناك قيم مسبقة
    if ($('#has_relatives').val() === '1') {
        $('#has_relatives').trigger('change');
    }
    if ($('#has_disabilities').val() === '1') {
        $('#has_disabilities').trigger('change');
    }
});



$(document).ready(function () {
    // عند تغيير حقل "هل شفت ثابت"
    $('#has_fixed_shift').change(function () {
        const hasFixedShift = $(this).val() === '1'; // 1 = نعم

        if (hasFixedShift) {
            // إظهار حقل أنواع الشفتات
            $('#shifts_type_container').show();
        } else {
            // إخفاء الحقل ومسح قيمته
            $('#shifts_type_container').hide();
            $('#shifts_type_id').val('');
        }
    });

    // تنفيذ التغيير عند التحميل إذا كانت هناك قيمة مسبقة
    if ($('#has_fixed_shift').val() === '1') {
        $('#has_fixed_shift').trigger('change');
    }
});



$(document).ready(function () {
    function toggleFields() {
        // الحقول الخاصة بالتأمين الاجتماعي
        if ($('#has_social_insurance').val() === '1') { // قيمة "نعم"
            $('#social_insurance_fields').show();
            $('#social_insurance_value').show();
        } else {
            $('#social_insurance_fields').hide();
            $('#social_insurance_value').hide();
        }

        // الحقول الخاصة بالتأمين الطبي
        if ($('#has_medical_insurance').val() === '1') {
            $('#medical_insurance_fields').show();
            $('#medical_insurance_value').show();
        } else {
            $('#medical_insurance_fields').hide();
            $('#medical_insurance_value').hide();
        }
    }

    // تشغيل الدالة عند تحميل الصفحة لأول مرة
    toggleFields();

    // تشغيل الدالة عند تغيير الاختيار
    $('#has_social_insurance, #has_medical_insurance').change(function () {
        toggleFields();
    });
});

$(document).ready(function () {
    function toggleMotivationFields() {
        // تحقق إن كانت القيمة "ثابت" (أي القيمة 3)
        if ($('select[name="motivation_type"]').val() === '3') {
            $('#fixed_motivation_value').show();
        } else {
            $('#fixed_motivation_value').hide();
        }
    }

    // تشغيل الدالة عند تحميل الصفحة
    toggleMotivationFields();

    // عند تغيير القيمة
    $('select[name="motivation_type"]').change(function () {
        toggleMotivationFields();
    });
});

$(document).ready(function () {
    $('#monthly_salary').on('input', function () {
        let monthlySalary = parseFloat($(this).val());

        if (!isNaN(monthlySalary) && monthlySalary > 0) {
            let dailySalary = Math.floor(monthlySalary / 30); // يحذف الكسور
            $('#daily_salary').val(dailySalary);
        } else {
            $('#daily_salary').val('');
        }
    });

    // لحساب القيمة عند تحميل الصفحة إذا كانت موجودة
    $('#monthly_salary').trigger('input');

});



$(document).ready(function () {
    // دالة لإدارة عرض الحقول
    function manageMilitaryFields() {
        var selectedOption = $('select[name="military"]').val();

        // إخفاء جميع الحقول أولاً
        $('.related_miltary_postponement, .related_miltary_exemption, .related_miltary_completed').hide();

        // إظهار الحقل المناسب بناءً على القيمة المحددة
        if (selectedOption === '3') {
            $('.related_miltary_completed').show();
        } else if (selectedOption === '1') {
            $('.related_miltary_postponement').show();
        } else if (selectedOption === '2') {
            $('.related_miltary_exemption').show();
        }
    }

    // تنفيذ الدالة عند التحميل الأولي
    manageMilitaryFields();

    // إضافة حدث تغيير لحقل الخدمة العسكرية
    $('select[name="military"]').change(manageMilitaryFields);
});