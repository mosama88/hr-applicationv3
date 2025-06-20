<?php

namespace App\Repositories\Settings;

use App\Models\FinanceCalendar;
use App\Models\FinanceClnPeriod;
use Illuminate\Support\Facades\Auth;
use App\Enums\FinanceCalendarsIsOpen;
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
        FinanceClnPeriod::where('finance_calendar_id', $financeCalendar->id)->delete();

        $financeCalendar->delete();

        return $financeCalendar;
    }
}