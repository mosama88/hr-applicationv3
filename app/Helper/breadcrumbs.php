<?php

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

if (!function_exists("generate_breadcrumbs")) {
    function generate_breadcrumbs()
    {
        $segments = Request::segments();
        $breadcrumbs = [];
        $url = '';

        // خريطة تربط بين اسم segment و الموديل
        $modelsMap = [
            // 'prosecutions' => Prosecution::class,
            // 'governorates' => Governorate::class,
            // زود اللي انت عايزه هنا
        ];

        foreach ($segments as $index => $segment) {
            $url .= '/' . $segment;

            $displayName = ucfirst($segment); // الافتراضي لو مش لاقي موديل

            // لو segment مش رقم (يعني ممكن slug)
            if (!is_numeric($segment)) {
                foreach ($modelsMap as $key => $modelClass) {
                    if (in_array($key, $segments)) {
                        $model = $modelClass::where('slug', $segment)->first();
                        if ($model) {
                            $displayName = $model->name . " #" . Str::limit(md5($model->id), 5, '');
                            break;
                        }
                    }
                }
            }

            // أضف الـ breadcrumb
            $breadcrumbs[] = [
                'text' => $displayName,
                'url'  => url($url),
            ];
        }

        return $breadcrumbs;
    }
}
