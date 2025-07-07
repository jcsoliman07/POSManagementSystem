<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
        //Validate Data
        $attributes = $request->validate([
            'email'     => ['required','email'],
            'password'  => ['required'],
        ]);

        $user = User::where('email', $attributes['email'])->first();

        //Validation if Email is Registered
        if(!Auth::attempt($attributes))
        {
            return back()->with('error', 'Invalid Credentials!');
        }

        if (Auth::attempt($attributes)) {

            $request->session()->regenerate();
            $user = Auth::user();

            switch($user->role->name)
            {
                case 'super_admin':
                case 'admin':
                    return redirect()->route('dashboard'); //Shared Dashboard for Admin and Super Admin
                case 'user':
                    return redirect()->route('user.dashboard'); //Redirect to the User Dashboard
                default:
                    abort(403);
            }
        }
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
