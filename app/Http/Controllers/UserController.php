<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // return view('components.layout');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validate Data
        $attributes = $request->validate([
            'email'     => ['required','email'],
            'password'  => ['required'],
        ]);

        //KULANG PA TO NG VERIFICATION IF USER IS EXIST OR PASSWORD IS THE ACCOUNT PASSWORD
        if (Auth::attempt($attributes)) {

            $request->session()->regenerate();
            $user = Auth::user();

            switch($user->role->name)
            {
                case 'super_admin':
                case 'admin':
                    return redirect()->route('dashboard'); //Shared Dashboard for Admin and Super Admin
                case 'user':
                    return('Hello from user!');
                default:
                    abort(403);
            }
        }

        return back()->withErrors(['email', 'Invalid Credentials']);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
