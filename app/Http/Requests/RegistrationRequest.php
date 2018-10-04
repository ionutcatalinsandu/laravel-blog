<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Mail\WelcomeAgain; 
use App\Mail;

class RegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required', 

            'email' => 'required|email', 

            'password' => 'required|confirmed'
        ];
    } 

    public function persist()
    {
        $user = new User(); 
        
        $user->name = $this->only('name')['name'];  // ASTA DA UN ARRAY FMM 
        
        $user->email = $this->only('email')['email'];   

        $user->password = bcrypt($this->only('password')['password']);  



        \Mail::to($user)->send(new WelcomeAgain($user)); //sending email

        $user->save(); 
        
        auth()->login($user); 
    }
}
