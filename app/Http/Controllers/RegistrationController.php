<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Mail;
use App\Mail\Welcome;
use App\Http\Requests\RegistrationRequest;

class RegistrationController extends Controller
{ 

    public function __construct()
    {
        $this->middleware('guest'); 
    }

    public function create()
    {
        return view('registration.create');
    } 


    public function store(RegistrationRequest $request)
    {   
        $request->persist(); 


        session()->flash('message', 'Thanks for signing up!');

        return redirect()->home();
    }
}
