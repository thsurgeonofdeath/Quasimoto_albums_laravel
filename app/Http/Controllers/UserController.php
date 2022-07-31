<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Create User via register form
    public function create(){
        return view('users.register');
    }
    //Store User in the database
    public function store(Request $request){
        $formFields = $request->validate([
            'name'      =>  ['required','min:3'],
            'email'     =>  ['required','email',Rule::unique('users','email')],
            'password'  =>  'required|confirmed|min:6'
        ]);

        //Hash password
        $formFields['password']=bcrypt($formFields['password']);
        //Create User and Login
        $user = User::create($formFields);
        $id = $user->id;
        DB::insert('insert into role_user(user_id,role_id) values (?,?)',[$id,3]);

        event(new Registered($user));

        auth()->login($user);
        return redirect('/')->with('message','User created and logged in');

    }
    //Logout
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message','you have been logged out bitch!');
    }
    //Login with existing user
    public function login(){
        return view('users.login');
    }
    //Authenticate with existing user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email'  =>  ['required','email'],
            'password'  =>  'required'
        ]);

        //Login the user
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message','Logged in successfully!!');
        }
        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');

    }

    //Show edit user info form
    public function edit(){
        $user = auth()->user();
        // dd($user);
        return view('users.edit',['user' => $user]);
    }

    //update User
    public function update(Request $request, User $user){

        $formFields = $request->validate([
            'name'      =>  ['required','min:3'],
            'password'  =>  'required|confirmed|min:6'
        ]);

        //Hash password
        $formFields['password']=bcrypt($formFields['password']);
        
        $user->update($formFields);
        return redirect('/')->with('message','Changes Applied Successfully!!!');
    }

    public function likes(){
        $albums = auth()->user()->likes;
        return view('users.likes',['albums' => $albums]);
    }
}
