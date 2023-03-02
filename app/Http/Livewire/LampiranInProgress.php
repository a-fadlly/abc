<?php

namespace App\Http\Livewire;

use App\Models\Biodata;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LampiranInProgress extends Component
{
    public $search = '';

    public function render()
    {
        $lampirans =  Lampiran::join('users', 'users.id', '=', 'lampirans.user_id')
            ->join('doctors', 'doctors.doctor_nu', '=', 'lampirans.doctor_nu')
            ->whereIn('lampirans.status', [1, 2])
            ->where('lampirans.created_by', Auth::user()->id)
            ->where(function ($query) {
                $query
                    ->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.username', 'like', '%' . $this->search . '%')
                    ->orWhere('doctors.doctor_nu', 'like', '%' . $this->search . '%')
                    ->orWhere('doctors.name', 'like', '%' . $this->search . '%');
            })
            ->select('lampiran_nu', 'user_id', 'doctors.doctor_nu', 'created_by', 'status', DB::raw('1 as type'))
            ->distinct();

        $biodatas = Biodata::select(DB::raw('id as lampiran_nu'), 'biodatas.user_id', DB::raw('"ut" as doctor_nu'), 'biodatas.created_by', 'biodatas.status', DB::raw('2 as type'));

        $result = $lampirans->union($biodatas)->get();

        // dd($results);

        return view('livewire.lampiran-in-progress', ['lampirans' => $result]);
    }
}
