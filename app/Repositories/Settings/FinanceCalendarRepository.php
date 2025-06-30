<?php

namespace App\Repositories\Settings;

use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriod;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceCalendarsIsOpen;
use App\Enums\FinanceClnPeriodsIsOpen;
use App\Repositories\Interfaces\Settings\FinanceCalendarInterface;

class FinanceCalendarRepository implements FinanceCalendarInterface
{


    public function getData()
    {
        $com_code = Auth::user()->com_code;
        $data =  FinanceCalendar::with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->paginate(10);
        return $data;
    }


    public function storeData($request)
    {
        $com_code = Auth::user()->com_code;
        $validateData = $request->validated();
        $dataToInsert = array_merge($validateData, [
            'is_open' => FinanceCalendarsIsOpen::Pending,
            'com_code' => $com_code,
            'created_by' => Auth::user()->id,
        ]);

        return FinanceCalendar::create($dataToInsert);
    }




    public function showData(FinanceCalendar $financeCalendar)
    {
        $com_code = Auth::user()->com_code;
        return  FinanceClnPeriod::where('finance_calendar_id', $financeCalendar->id)->where('com_code', $com_code)->get();
    }


    public function updateData($request, FinanceCalendar $financeCalendar)
    {
        $com_code = Auth::user()->com_code;
        $validatedData = $request->validated();

        $dataToInsert = array_merge($validatedData, [
            'com_code' => $com_code,
            'updated_by' => Auth::user()->id,
        ]);

        $financeCalendar->update($dataToInsert);

        return $financeCalendar;
    }


    public function deleteData(FinanceCalendar $financeCalendar)
    {
        $com_code = Auth::user()->com_code;
        if ($financeCalendar->com_code != $com_code) {
            throw new \Exception('عفوآ لقد حدث خطأ ما!');
        }
        // Check if any financial year is still open
        $openYearsCount = FinanceCalendar::where('com_code', $com_code)
            ->where('is_open', FinanceCalendarsIsOpen::Open)
            ->count();

        if ($openYearsCount > 0) {
            throw new \Exception('عفوآ ! السنة المالية مازالت مفتوحة');
        }

        // Check for open periods
        $openPeriodsCount = FinanceClnPeriod::where('com_code', $com_code)
            ->where('finance_calendar_id', $financeCalendar->slug)
            ->where('is_open', "!=", FinanceClnPeriodsIsOpen::Archived)
            ->count();
        if ($openPeriodsCount > 0) {
            throw new \Exception('عفوآ ! يوجد شهور مالية مفتوحة او معلقة. لا يمكن حذف السنة المالية حتى يتم أرشفة جميع الشهور');
        }



        // Perform deletion
        FinanceClnPeriod::where('finance_calendar_id', $financeCalendar->id)->delete();
        $financeCalendar->delete();

        return $financeCalendar;
    }




    public function openYearData(FinanceCalendar $financeCalendar)
    {

        $com_code = Auth::user()->com_code;
        //التأكد ان السنه معلقه
        if ($financeCalendar->is_open != FinanceCalendarsIsOpen::Pending) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'عفوآ ! . لا يمكن فتح السنه فى هذه الحاله']);
        }

        $checkDataOpenCount = FinanceCalendar::where('com_code', $com_code)->where('is_open', FinanceCalendarsIsOpen::Open)->count();
        //التأكد ان لا يوجد سنه مفتوحه اخرى
        if ($checkDataOpenCount > 0) {
            return redirect()
                ->back()
                ->withErrors(['error' => 'عفوآ ! . يوجد سنه مالية مازالت مفتوحة']);
        }

        if ($financeCalendar->com_code != $com_code) {
            return redirect()->back()
                ->withErrors(['error' => 'عفوآ لقد حدث خطأ ما!']);
        }

        $financeCalendar->is_open = FinanceCalendarsIsOpen::Open;
        $financeCalendar->save();

        return $financeCalendar;
    }



    public function closeYearData(FinanceCalendar $financeCalendar)
    {

        $com_code = Auth::user()->com_code;
        // التأكد ان الشهور المالية تساوى 3
        $checkDataOpenCount = FinanceClnPeriod::where('com_code', $com_code)->where('finance_calendar_id', $financeCalendar->id)
            ->where('is_open', "!=", FinanceClnPeriodsIsOpen::Archived)->count();
        if ($checkDataOpenCount > 0) {
            return redirect()
                ->back()->withErrors(['error' => 'عفوآ ! . يوجد شهور مالية مفتوحة او معلقه . لا يمكن غلق السنة المالية حتى يتم أرشفة جميع الشهور']);
        }

        if ($financeCalendar->com_code != $com_code) {
            return redirect()->back()->withErrors(['error' => 'عفوآ لقد حدث خطأ ما!']);
        }
        $financeCalendar->is_open = FinanceCalendarsIsOpen::Archived;
        $financeCalendar->save();

        return $financeCalendar;
    }
}