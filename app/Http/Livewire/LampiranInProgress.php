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
        $lampirans =  Lampiran::join('users', 'users.username', '=', 'lampirans.username')
            ->join('doctors', 'doctors.doctor_nu', '=', 'lampirans.doctor_nu')
            ->whereIn('lampirans.status', [1, 2, 4])
            ->where('lampirans.created_by', Auth::user()->username)
            ->where(function ($query) {
                $query
                    ->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.username', 'like', '%' . $this->search . '%')
                    ->orWhere('doctors.doctor_nu', 'like', '%' . $this->search . '%')
                    ->orWhere('doctors.name', 'like', '%' . $this->search . '%');
            })
            ->select('lampiran_nu', 'lampirans.username', 'doctors.doctor_nu', 'created_by', 'status', DB::raw('"Lampiran" as tipe'))
            ->distinct();

        $biodatas = Biodata::join('users', 'users.username', '=', 'biodatas.username')
            ->whereIn('biodatas.status', [1, 2, 4])
            ->where('biodatas.created_by', Auth::user()->username)
            ->where(function ($query) {
                $query
                    ->where('users.name', 'like', '%' . $this->search . '%')
                    ->orWhere('users.username', 'like', '%' . $this->search . '%');
            })
            ->select(
                DB::raw('biodatas.id as lampiran_nu'),
                'biodatas.username',
                DB::raw('biodatas.name as doctor_nu'),
                'created_by',
                'status',
                DB::raw('"Ajuan Baru" as tipe')
            )
            ->distinct();

        $lampiransAndBiodatas = $lampirans->union($biodatas)->get();


        //dd($lampirans);
        //kalo kosong, coba cek get(); nya
        return view('livewire.lampiran-in-progress', ['lampirans' => $lampiransAndBiodatas]);
    }
}
