<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showLoginPage()
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

    public function showCorrectHomepage()
    {
        if (auth()->check()) {
            return view('home');
        } else {
            return view('login');
        }
    }

    public function showCreateForm()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        // $incomingFields = $request->validate([
        //     'name' => ['required', 'min:3'],
        //     'username' => ['required', Rule::unique('users', 'username')],
        //     'email' => ['required', 'email', Rule::unique('users', 'email')],
        //     'password' => ['required', 'min:1', 'max:8'],
        //     'rayon' => [],
        //     'regional' => [],
        // ]);

        // $user = new User();
        // $user->name = $incomingFields['name'];
        // $user->username = $incomingFields['username'];
        // $user->email = $incomingFields['email'];
        // $user->password = bcrypt($incomingFields['password']);
        // $additioanal_details['rayon'] = $incomingFields['rayon'];
        // $additioanal_details['regional'] = $incomingFields['regional'];
        // $user->additional_details = json_encode($additioanal_details);
        // $user->save();

        return redirect('/users');
    }

    public function getIndex()
    {
        // $users = User::paginate(15);
        return view('user.index');
    }

    public function showUpdateForm($id)
    {
        $user = User::where(['id' => $id])->first();
        return view('user.update', ['user' => $user]);
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
