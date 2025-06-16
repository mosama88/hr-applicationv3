$(document).ready(function () {
    $('.date-picker').flatpickr({
        dateFormat: "Y-m-d",
        allowInput: true,
        appendTo: document.body
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
    // عند تغيير حالة الخدمة العسكرية
    $('#military_status').change(function () {
        const status = $(this).val();

        // إخفاء جميع الحقول أولاً
        $('#exemption_temporary_fields').hide();
        $('#final_exemption_fields').hide();
        $('#complete_service_fields').hide();

        // مسح القيم عند الإخفاء
        $('#exemption_temporary_fields input').val('');
        $('#final_exemption_fields input').val('');
        $('#complete_service_fields input').val('');

        // إظهار الحقول المناسبة حسب الحالة المختارة
        if (status === '1') { // إعفاء مؤقت
            $('#exemption_temporary_fields').show();
        } else if (status === '2') { // إعفاء نهائي
            $('#final_exemption_fields').show();
        } else if (status === '3') { // أدى الخدمة
            $('#complete_service_fields').show();
        }
        // حالة "ليس لديه" (4) أو فارغ لا تظهر أي حقول
    });

    // تنفيذ التغيير عند التحميل إذا كانت هناك قيمة مسبقة
    if ($('#military_status').val()) {
        $('#military_status').trigger('change');
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




    $('#country_id').change(function () {
        var countryId = $(this).val();
        if (countryId) {
            $.ajax({
                url: '/dashboard/employees/get-governorates/' +
                    countryId, // أضيف '/' في البداية
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#governorate_id').empty();
                    $('#governorate_id').append(
                        '<option value="">-- أختر المحافظة --</option>');
                    $.each(data, function (key, value) {
                        $('#governorate_id').append('<option value="' + key +
                            '">' + value + '</option>');
                    });
                    $('#governorate_id').trigger('change');
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error); // لتتبع الأخطاء
                }
            });
        } else {
            $('#governorate_id').empty();
            $('#governorate_id').append('<option value="">-- أختر المحافظة --</option>');
        }
    });
});

$(document).ready(function () {
    $('#governorate_id').change(function () {
        var governorateId = $(this).val();
        if (governorateId) {
            $.ajax({
                url: '/dashboard/employees/get-cities/' +
                    governorateId, // أضيف '/' في البداية
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#city_id').empty();
                    $('#city_id').append(
                        '<option value="">-- أختر المدينه --</option>');
                    $.each(data, function (key, value) {
                        $('#city_id').append('<option value="' + key + '">' +
                            value + '</option>');
                    });
                    $('#city_id').trigger('change');
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error); // لتتبع الأخطاء
                }
            });
        } else {
            $('#city_id').empty();
            $('#city_id').append('<option value="">-- أختر المدينه --</option>');
        }
    });
});
