<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Lampiran;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $incomingFields = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt(['username' => $incomingFields['username'], 'password' => $incomingFields['password']])) {
            $request->session()->regenerate();

            //test
            $usernames = User::where('reporting_manager', '=', Auth::user()->username)
                ->orWhere('reporting_manager_manager', '=', Auth::user()->username)
                ->pluck('username')
                ->toArray();

            Session::put('usernames', $usernames);
            //end test

            return redirect('/');
        }

        return back()->withErrors([
            'username' => 'The provide credentials do not match our records.'
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }

    public function homepage()
    {
        if (auth()->check()) {
            $count = User::where(function ($query) {
                $query
                    ->where('reporting_manager_manager', Auth::user()->username)
                    ->orWhere('reporting_manager', Auth::user()->username);
            })->select('username')->get();

            $usernames = Session::get('usernames');

            $sumSales = Lampiran::whereIn('username', $usernames)->where('is_expired', 0)->sum('sales');
            $countDoctors = Lampiran::whereIn('username', $usernames)->where('is_expired', 0)->select('doctor_nu')->distinct()->get();
            $countOutlets = Lampiran::whereIn('username', $usernames)->where('is_expired', 0)->select('outlet_nu')->distinct()->get();

            return view('home', [
                'count' => count($count),
                'sumSales' => $sumSales,
                'countOutlets' => count($countOutlets),
                'countDoctors' => count($countDoctors)
            ]);
        } else {
            return view('login');
        }
    }

    public function showCreateForm()
    {
        return view('user.create');
    }

    public function getIndex()
    {
        return view('user.index');
    }

    public function showUpdateForm($user_id)
    {
        return view('user.update', ['user_id' => $user_id]);
    }

    public function view($lampiran_nu)
    {
        return view('lampiran.view', ['lampiran_nu' => $lampiran_nu]);
    }

    public function delete(Request $request)
    {
        $incomingFields = $request->validate(['id' => ['required']]);
        try {
            User::find($incomingFields['id'])->delete();
        } catch (Exception $e) {
            return redirect('/users')->with('failure', 'Error: Failed to delete.');
        }
        return back();
    }
}
