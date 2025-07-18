@php
    use App\Enums\Salaries\SanctionTypeEnum;
@endphp
<!DOCTYPE html>
<html>

<head>
    <title>تقرير الجزاءات</title>

    <style>
        /* تنسيق عام */
        body {
            font-family: Arial, sans-serif;
            direction: rtl;
            margin: 0;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #4d4d4e;
            color: white;
        }

        /* تنسيق خاص بالطباعة */
        @media print {
            @page {
                margin: 0;
                size: A4;
            }

            body {
                padding: 1cm;
            }

            /* إخفاء الروابط والعنوان في الطباعة */
            a:after {
                content: "" !important;
            }

            /* إخفاء الـ URL والعنوان الذي يضعه المتصفح */
            @page {
                marks: none;
            }

            /* إخفاء أي عناصر أخرى غير مرغوب فيها */
            .no-print,
            .dont-print {
                display: none !important;
            }

            /* إزالة أي هوامش إضافية */
            html,
            body {
                width: 100%;
                height: auto;
                margin: 0 !important;
                padding: 0 !important;
            }

            /* منع تقسيم الصفوف بين الصفحات */
            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>تقرير الجزاءات ({{ $sanctions->count() }} جزاء) </h2>
        <p>تاريخ التقرير: {{ now()->format('Y-m-d') }}</p>
        <p>إجمالى الجزاءات: {{ number_format($sanctions->sum('total'), 2) }} جنيه</p>

    </div>

    <table>
        <thead>
            <tr>
                <th>كود الموظف</th>
                <th>اسم الموظف</th>
                <th>الادارة</th>
                <th>الفرع</th>
                <th>نوع الجزاء</th>
                <th>عدد الأيام</th>
                <th>القيمة</th>
                <th>التاريخ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sanctions as $sanction)
                <tr>
                    <td>{{ $sanction->employee_code }}</td>
                    <td>{{ $sanction->mainSalaryEmployee->employee_name }}</td>
                    <td>{{ $sanction->mainSalaryEmployee->department->name }}</td>
                    <td>{{ $sanction->mainSalaryEmployee->branch->name }}</td>
                    <td>
                        @if ($sanction->sanctions_type)
                            {{ $sanction->sanctions_type->label() }}
                        @endif
                    </td>
                    <td>{{ $sanction->value * 1 }}</td>
                    <td>{{ $sanction->total * 1 }}</td>
                    <td>{{ $sanction->financeClnPeriod->year_and_month ?? 'غير معروف' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="no-print" style="margin-top: 20px; text-align: center;">
        <button onclick="window.print()" class="btn" style="background-color: #4d4d4e; color: white;">
            <i class="fa-solid fa-print ml-2"></i> طباعة التقرير
        </button>
    </div>

</body>

</html>
