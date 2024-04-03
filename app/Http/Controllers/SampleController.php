<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SampleController extends Controller
{
    function index()
    {
        if(Auth::check()) {
            return redirect('/');
        }
        return view('login');
    }

    function registration()
    {
        if(Auth::check()) {
            return redirect('/');
        }
        return view('registration');
    }

    function validate_registration(Request $request)
    {
        $request->validate([
            'name'         =>   'required',
            'email'        =>   'required|email|unique:users',
            'password'     =>   'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'name'  =>  $data['name'],
            'email' =>  $data['email'],
            'password' => Hash::make($data['password'])
        ]);

        return redirect('login')->with('success', 'Registration Completed, now you can login');
    }

    function validate_login(Request $request)
    {
        $request->validate([
            'email' =>  'required',
            'password'  =>  'required'
        ]);

        $credentials = $request->only('email', 'password');

        if(Auth::attempt($credentials))
        {
            return redirect('home');
        }

        return redirect('login')->with('success', 'Login details are not valid');
    }

    function home()
    {
        if(Auth::check())
        {
            return view('home');
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    function about()
    {
        if(Auth::check())
        {
            return view('about');
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }


    function beachvolley()
    {
        if(Auth::check())
        {
            return view('beachvolley');
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    function contact()
    {
        if(Auth::check())
        {
            return view('contact');
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }

    function feature()
    {
        if(Auth::check())
        {
            return view('feature');
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }


    function hardcourt()
    {
        if(Auth::check())
        {
            return view('hardcourt');
        }

        return redirect('login')->with('success', 'you are not allowed to access');
    }


    function logout()
    {
        Session::flush();

        Auth::logout();

        return Redirect('/');
    }
}
