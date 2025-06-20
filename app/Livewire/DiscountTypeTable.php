<?php

namespace App\Livewire;

use App\Models\DiscountType;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class DiscountTypeTable extends Component
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

        $query = DiscountType::query();

        if ($this->name) {
            $query->where('name', 'LIKE', '%' . $this->name . '%');
        }

        $com_code  = Auth::user()->com_code;
        $data = $query->with(['createdBy:id,name', 'updatedBy:id,name'])->where('com_code', $com_code)->orderByDesc('id')->paginate(10);

        return view('dashboard.employee-affairs.discount_types.discount-type-table', compact('data'));
    }
}