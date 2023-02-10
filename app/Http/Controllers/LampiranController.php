<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lampiran;
use Illuminate\Http\Request;
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

class LampiranController extends Controller
{
    public function index()
    {
        $role_id = Auth::user()->role_id;
        $countLampiranThatNeedToBeApproved = 0;
        if ($role_id === config('constants.REGIONAL_SALES_MANAGER')) {
            //select semua id dm/bawahannya
            $ids = User::where('reporting_manager', '=', Auth::id())->pluck('id')->toArray();
            $countLampiranThatNeedToBeApproved = Lampiran::whereIn('user_id', $ids)
                ->where('status', '=', config('constants.INITIATED'))
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'user_id', 'doctor_nu', 'periode')
                ->distinct()
                ->count();
        } elseif ($role_id === config('constants.MARKETING_MANAGER')) {
            //select semua id rsm/bawahannya
            $ids = User::where('reporting_manager', '=', Auth::id())->pluck('id')->toArray();
            foreach ($ids as $id) {
                array_push($ids, User::where('reporting_manager', '=', $id)->pluck('id')->toArray());
            }
            $countLampiranThatNeedToBeApproved = Lampiran::whereIn('user_id', flattenArray($ids))
                ->where('status', '=', config('constants.APPROVED_BY_REGIONAL_SALES_MANAGER'))
                ->with('user:id,name', 'doctor:doctor_nu,name')
                ->select('lampiran_nu', 'user_id', 'doctor_nu', 'periode')
                ->distinct()
                ->count();
        }





        $countLampiranInProgress = Lampiran::with('user:id,name', 'doctor:doctor_nu,name')
            ->where('created_by', '=', Auth::id())
            ->orWhere('user_id', '=', Auth::id())
            ->select('lampiran_nu', 'user_id', 'doctor_nu')
            ->distinct()->count();
        return view(
            'lampiran.index',
            [
                'countLampiranInProgress' => $countLampiranInProgress,
                'countLampiranThatNeedToBeApproved' => $countLampiranThatNeedToBeApproved
            ]
        );
    }

    public function showCreateForm()
    {
        return view('lampiran.create');
    }

    public function inProgress()
    {
        return view('lampiran.in-progress');
    }

    public function history()
    {
        return view('lampiran.history');
    }

    public function view($lampiran_nu)
    {
        return view('lampiran.view', ['lampiran_nu' => $lampiran_nu]);
    }

    public function approval()
    {
        return view('lampiran.approval');
    }
}
