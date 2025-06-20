<?php

namespace App\Livewire;

use App\Models\AdditionalType;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AdditionalTypeTable extends Component
{
    use WithPagination;

    public $name;

    public function refresh()
    {
        $this->reset('name');

        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function clear()
    {
        $this->name = null;
        $this->resetPage();
    }

    public function render()
    {

        $query = AdditionalType::query();

        if ($this->name) {
            $query->where('name', 'LIKE', '%' . $this->name . '%');
        }

        $com_code  = Auth::user()->com_code;
        $data = $query->with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);

        return view('dashboard.employee-affairs.additional_types.additional-type-table', compact('data'));
    }
}