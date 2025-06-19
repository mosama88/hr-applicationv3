<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Models\Branch;
use App\Enums\StatusActiveEnum;
use Illuminate\Http\Request;
use App\Services\Settings\BranchService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Dashboard\Settings\BranchRequest;

class BranchController extends Controller
{

    public function __construct(protected BranchService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->service->index();
        return view('dashboard.settings.branches.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.settings.branches.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BranchRequest $request)
    {
        $this->service->store($request);
        return redirect()->route('dashboard.branches.index')->with('success', 'تم أضافة الفرع بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        return view('dashboard.settings.branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        return view('dashboard.settings.branches.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BranchRequest $request, Branch $branch)
    {

        $this->service->update($request, $branch);
        return redirect()->route('dashboard.branches.index')->with('success', 'تم تعديل الفرع بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $this->service->destroy($branch);
        return response()->json([
            'success' => true,
            'message' => 'تم حذف الفرع بنجاح'
        ]);
    }
}