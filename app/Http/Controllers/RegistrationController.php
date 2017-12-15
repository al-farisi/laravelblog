<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\RegistrationForm;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('registration.create');
    }

    public function store(RegistrationForm $form)
    {
        //validate
        // $this->validate(request(),[
        //     'name' => 'required',
        //     'email' => 'required|email',
        //     'password' => 'required|confirmed'
        // ]);

        $form->persist();

        session()->flash('message', 'Thanks so much for signing up');

        //redirect to home page
        return redirect()->home();
    }
}
