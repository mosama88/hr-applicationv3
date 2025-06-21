<?php

namespace App\Http\Controllers\Dashboard\Settings;



use Exception;
use Illuminate\Http\Request;
use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriod;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceCalendarsIsOpen;
use App\Enums\FinanceClnPeriodsIsOpen;
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

    public function openYear(FinanceCalendar $financeCalendar)
    {
        try {

            $com_code = Auth::user()->com_code;
            //التأكد ان السنه معلقه
            if ($financeCalendar->is_open != FinanceCalendarsIsOpen::Pending) {
                return redirect()
                    ->route('dashboard.financeCalendars.index')
                    ->withErrors(['error' => 'عفوآ ! . لا يمكن فتح السنه فى هذه الحاله']);
            }

            $checkDataOpenCount = FinanceCalendar::where('com_code', $com_code)->where('is_open', FinanceCalendarsIsOpen::Open)->count();
            //التأكد ان لا يوجد سنه مفتوحه اخرى
            if ($checkDataOpenCount > 0) {
                return redirect()
                    ->route('dashboard.financeCalendars.index')
                    ->withErrors(['error' => 'عفوآ ! . يوجد سنه مالية مازالت مفتوحة']);
            }

            if ($financeCalendar->com_code != $com_code) {
                return redirect()->route('dashboard.financeCalendars.index')
                    ->withErrors(['error' => 'عفوآ لقد حدث خطأ ما!']);
            }
            DB::beginTransaction();

            $financeCalendar->is_open = FinanceCalendarsIsOpen::Open;
            $financeCalendar->save();
            DB::commit();
            return redirect()->route('dashboard.financeCalendars.index')->with('success', 'تم فتح السنة المالية بنجاح');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوآ ! . حدث خطأ' . $ex->getMessage()]);
        }
    }


    public function closeYear(FinanceCalendar $financeCalendar)
    {
        try {
            $com_code = Auth::user()->com_code;
            // التأكد ان الشهور المالية تساوى 3
            $checkDataOpenCount = FinanceClnPeriod::where('com_code', $com_code)->where('finance_calendar_id', $financeCalendar->id)
                ->where('is_open', "!=", FinanceClnPeriodsIsOpen::Archived)->count();
            if ($checkDataOpenCount > 0) {
                return redirect()
                    ->route('dashboard.financeCalendars.index')
                    ->withErrors(['error' => 'عفوآ ! . يوجد شهور مالية مفتوحة او معلقه . لا يمكن غلق السنة المالية حتى يتم أرشفة جميع الشهور']);
            }

            if ($financeCalendar->com_code != $com_code) {
                return redirect()->route('dashboard.financeCalendars.index')
                    ->withErrors(['error' => 'عفوآ لقد حدث خطأ ما!']);
            }
            DB::beginTransaction();
            $financeCalendar->is_open = FinanceCalendarsIsOpen::Archived;
            DB::commit();
            $financeCalendar->save();
            return redirect()->route('dashboard.financeCalendars.index')->with('success', 'تم غلق السنة المالية بنجاح');
        } catch (Exception $ex) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'عفوآ ! . حدث خطأ' . $ex->getMessage()]);
        }
    }
}