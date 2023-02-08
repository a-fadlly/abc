<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserGrid extends Component
{
    public $search = '';
    public $sortBy;
    public $sortDirection;

    protected $updatesQueryString = ['sortBy', 'sortDirection', 'search'];

    public function sortBy($field)
    {
        if ($this->sortBy == $field) {
            $this->sortDirection = $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortBy = $field;
            $this->sortDirection = 'asc';
        }
    }

    public function render()
    {
        $users = User::where(function ($query) {
            if ($this->search) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('username', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%');
            }
        })
            ->orderBy($this->sortBy ?? 'name', $this->sortDirection ?? 'asc')
            ->paginate(10);

        return view('livewire.user-grid', ['users' => $users]);
    }
}
