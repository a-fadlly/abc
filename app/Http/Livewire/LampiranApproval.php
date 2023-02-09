<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Lampiran;
use Illuminate\Support\Facades\Auth;

function flattenArray($array)
{
    $flattenedArray = [];
    foreach ($array as $value) {
        if (is_array($value)) {
            $flattenedArray = array_merge($flattenedArray, flattenArray($value));
        } else {
            array_push($flattenedArray, $value);
        }
    }
    return $flattenedArray;
}

class LampiranApproval extends Component
{
    public function render()
    {
        $role_id = Auth::user()->role_id;
        if ($role_id === 2) {
            $ids = User::where('reporting_manager', '=', Auth::id())->pluck('id');
            $lampirans = Lampiran::whereIn('user_id', $ids)
                ->where('status', '=', 1)
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'user_id', 'doctor_nu')
                ->distinct()
                ->get();
        } elseif ($role_id === 3) {
            $ids = User::where('reporting_manager', '=', Auth::id())->pluck('id')->toArray();
            foreach ($ids as $id) {
                array_push($ids, User::where('reporting_manager', '=', $id)->pluck('id')->toArray());
            }
            $lampirans = Lampiran::whereIn('user_id', flattenArray($ids))
                ->where('status', '=', 2)
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'user_id', 'doctor_nu')
                ->distinct()
                ->get();
        }

        return view('livewire.lampiran-approval', ['lampirans' => $lampirans]);
    }
}
