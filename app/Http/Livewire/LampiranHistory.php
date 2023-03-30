<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

class LampiranHistory extends Component
{
    public $username = '';
    public $doctor = '';

    public function render()
    {

        $users = Lampiran::where('lampirans.created_by', Auth::user()->username)->select('username')
            ->distinct()
            ->get();

        $lampirans = Lampiran::join('users', 'users.username', '=', 'lampirans.username')
            ->join('doctors', 'doctors.doctor_nu', '=', 'lampirans.doctor_nu')
            // ->whereIn('lampirans.status', [3, 4, 5])
            ->where('lampirans.status', 4)
            ->where('lampirans.is_expired', '0')
            ->where('lampirans.created_by', Auth::user()->username)
            ->when($this->username, function ($query) {
                return $query->where('users.name', '=', $this->username);
            })
            ->where(function ($query) {
                $query
                    ->where('doctors.doctor_nu', 'like', '%' . $this->doctor . '%')
                    ->orWhere('doctors.name', 'like', '%' . $this->doctor . '%');
            })
            ->select('lampiran_nu', 'users.username', 'users.name', 'doctors.doctor_nu', 'created_by', 'lampirans.updated_at','status')
            ->orderBy('lampirans.updated_at', 'DESC')
            ->orderBy('users.name', 'ASC')
            ->orderBy('doctors.name', 'ASC')
            ->distinct()
            ->get();

        // dd($lampirans);


        return view('livewire.lampiran-history', ['lampirans' => $lampirans, 'users' => $users]);
    }
}
