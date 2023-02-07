<?php

namespace App\Http\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\User;

class UserTable extends DataTableComponent
{
    protected $model = User::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable(),
            Column::make("Username", "username")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make('Actions')
                ->label(
                    function ($row, Column $column) {
                        $edit = '<button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" wire:click="edit(' . $row->id . ')"><i class="fa fa-edit"></i></button>';
                        $delete = '<button class="w-4 mr-2 transform hover:text-red-500 hover:scale-110" wire:click="delete(' . $row->id . ')"><i class="fa fa-trash"></i></button>';
                        return $edit . " " . $delete;
                    }
                )->html(),
        ];
    }

    public function edit($id)
    {
        return redirect('/users/' . $id . '/update');
    }


    public function delete()
    {
    }
}
