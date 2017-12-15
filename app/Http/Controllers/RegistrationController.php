<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail\Welcome;
use App\Mail\WelcomeAgain;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store()
    {
        //validate
        $this->validate(request(),[
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ]);

        //create user
        //$user =  User::create(request(['name', 'email', 'password']));
        $user =  User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password'))
        ]);

        //sign them in
        auth()->login($user);

        \Mail::to($user)->send(new WelcomeAgain($user));

        //redirect to home page
        return redirect()->home();
    }
}
