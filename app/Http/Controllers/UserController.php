<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function login(Request $request) {
        $incoming_fields = $request->validate([
            'loginname' => 'required',
            'loginpassword' => 'required'
        ]);

        if (auth()->attempt(['name'=> $incoming_fields['loginname'], 'password' => $incoming_fields['loginpassword']])) {
            $request->session()->regenerate();
        }

        return redirect('/');
    }
    
    public function register(Request $request){
        $incoming_fields = $request->validate([
            'name' => ['required', 'min: 3', 'max: 10', Rule::unique('users', 'name')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min: 8', 'max: 200']
        ]);

        $incoming_fields['password'] = bcrypt($incoming_fields['password']);
        $user = User::create($incoming_fields);
        auth()->login($user);
        return redirect('/');
    }

    public function logout() {
        auth()->logout();
        return redirect('/');
    }
}
