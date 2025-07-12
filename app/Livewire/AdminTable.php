<?php

namespace App\Livewire;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class AdminTable extends Component
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

        $query = Admin::query();

        if ($this->name) {
            $query->where('name', 'LIKE', '%' . $this->name . '%')->orWhere('mobile', 'LIKE', '%' . $this->name . '%')
                ->orWhere('email', 'LIKE', '%' . $this->name . '%');
        }

        $com_code  = Auth::user()->com_code;
        $data = $query->where('com_code', $com_code)->orderByDesc('id')->paginate(10);
        return view('dashboard.admin-roles.admins.admin-table', compact('data'));
    }
}