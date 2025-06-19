<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Enums\StatusActiveEnum;
use App\Services\LanguageService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\LanguageRequest;

class LanguageController extends Controller
{

    public function __construct(protected LanguageService $service) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /**
         * Display a listing of the resource.
         */
        $data = $this->service->index();

        return view('dashboard.settings.languages.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.languages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LanguageRequest $request)
    {
        $this->service->store($request);

        return redirect()->route('dashboard.languages.index')->with('success', 'تم أضافة اللغه بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Language $language)
    {
        return view('dashboard.settings.languages.show', compact('language'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Language $language)
    {
        return view('dashboard.settings.languages.edit', compact('language'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LanguageRequest $request, Language $language)
    {
        $this->service->update($request, $language);

        return redirect()->route('dashboard.languages.index')->with('success', 'تم تعديل اللغه بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Language $language)
    {
        $this->service->destroy($language);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف اللغه بنجاح'
        ]);
    }


    function searchlanguage(Request $request)
    {
        $languages = $this->service->searchlanguage($request);
        return response()->json([
            'data' => $languages
        ]);
    }
}