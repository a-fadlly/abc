<?php

namespace App\Http\Livewire;

use App\Models\Biodata;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LampiranInProgress extends Component
{
    public $username = '';
    public $doctor = '';

    public function render()
    {
        $usersLampirans = Lampiran::where('lampirans.created_by', Auth::user()->username)
            ->whereIn('lampirans.status', [1, 2])
            ->select('username')
            ->distinct();

        $usersBiodatas = Biodata::where('biodatas.created_by', Auth::user()->username)
            ->whereIn('biodatas.status', [1, 2, 4])
            ->select('username')
            ->distinct();

        $usersLampiransAndBiodatas = $usersLampirans->union($usersBiodatas)->get();


        $lampirans =  Lampiran::join('users', 'users.username', '=', 'lampirans.username')
            ->join('doctors', 'doctors.doctor_nu', '=', 'lampirans.doctor_nu')
            ->whereIn('lampirans.status', [1, 2])
            ->where('lampirans.created_by', Auth::user()->username)
            ->where(function ($query) {
                $query
                    ->where('users.name', 'like', '%' . $this->username . '%');
            })
            ->where(function ($query) {
                $query
                    ->orWhere('doctors.doctor_nu', 'like', '%' . $this->doctor . '%')
                    ->orWhere('doctors.name', 'like', '%' . $this->doctor . '%');
            })
            ->select('lampiran_nu', 'lampirans.username', 'doctors.doctor_nu', 'created_by', 'status', DB::raw('"Lampiran" as tipe'))
            ->distinct();

        $biodatas = Biodata::join('users', 'users.username', '=', 'biodatas.username')
            ->whereIn('biodatas.status', [1, 2, 4])
            ->where('biodatas.created_by', Auth::user()->username)
            ->where(function ($query) {
                $query
                    ->where('users.name', 'like', '%' . $this->username . '%');
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
        return view('livewire.lampiran-in-progress', ['lampirans' => $lampiransAndBiodatas, 'users' => $usersLampiransAndBiodatas]);
    }
}
