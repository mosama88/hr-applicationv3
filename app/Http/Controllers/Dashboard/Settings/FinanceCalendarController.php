<?php

namespace App\Http\Controllers\Dashboard\Settings;



use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\Settings\FinanceCalendarService;
use App\Http\Requests\Dashboard\Settings\FinanceCalendarRequest;

class FinanceCalendarController extends Controller
{

    public function __construct(protected FinanceCalendarService $financeCalendarService) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->financeCalendarService->index();
        return view('dashboard.settings.financeCalendars.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.financeCalendars.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FinanceCalendarRequest $request)
    {
        $this->financeCalendarService->store($request);
        return redirect()->route('dashboard.financeCalendars.index')->with('success', 'تم أضافة السنه المالية بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(FinanceCalendar $financeCalendar)
    {
        try {
            $financeClnPeriods = $this->financeCalendarService->show($financeCalendar);
            return view('dashboard.settings.financeCalendars.show', compact('financeClnPeriods', 'financeCalendar'));
        } catch (\Exception $e) {
            return redirect()
                ->route('dashboard.financeCalendars.index')
                ->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FinanceCalendar $financeCalendar)
    {
        return view('dashboard.settings.financeCalendars.edit', compact('financeCalendar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FinanceCalendarRequest $request, FinanceCalendar $financeCalendar)
    {
        $this->financeCalendarService->update($request, $financeCalendar);

        return redirect()->route('dashboard.financeCalendars.index')->with('success', 'تم تعديل السنة المالية بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FinanceCalendar $financeCalendar)
    {

        $this->financeCalendarService->destroy($financeCalendar);

        return response()->json([
            'success' => true,
            'message' => 'تم حذف السنه المالية بنجاح'
        ]);
    }
}