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

class LampiranRequisition extends Component
{
    public function render()
    {
        $role_id = Auth::user()->role_id;
        $lampirans = [];
        if ($role_id === config('constants.REGIONAL_SALES_MANAGER')) {
            //select semua id dm/bawahannya
            $ids = User::where('reporting_manager', '=', Auth::id())->pluck('id')->toArray();
            $lampirans = Lampiran::whereIn('created_by', $ids)
                ->where('status', '=', config('constants.INITIATED'))
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'user_id', 'doctor_nu', 'periode', 'created_by')
                ->distinct()
                ->get();
        } elseif ($role_id === config('constants.MARKETING_MANAGER')) {

            //select semua id rsm/bawahannya
            $ids = User::where('reporting_manager', '=', Auth::id())->pluck('id')->toArray();
            foreach ($ids as $id) {
                array_push($ids, User::where('reporting_manager', '=', $id)->pluck('id')->toArray());
            }

            //dd(flattenArray($ids));


            $lampirans = Lampiran::whereIn('created_by', flattenArray($ids))
                ->where('status', '=', config('constants.APPROVED_BY_REGIONAL_SALES_MANAGER'))
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'user_id', 'doctor_nu', 'periode', 'created_by')
                ->distinct()
                ->get();
        }

        return view('livewire.lampiran-requisition', ['lampirans' => $lampirans]);
    }
}
