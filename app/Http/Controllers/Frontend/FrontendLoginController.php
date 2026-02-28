<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserloginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class FrontendLoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index()
    {
        return view('Frontend.frontendlogin');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    //  public function login(UserloginRequest $request)
    //  {
    //     $login =[
    //         'email' => $request->email,
    //         'password' => $request->password,
    //         'level' => 0
    //     ];



    //     $remember = false;
    //     // Keep me signing up
    //     if($request->remember_me){
    //         $remember = true;
    //     }
    //     //Ham Auth::attempt dung de check login bang kiem tra gia tri truyen vao va gia tri trong database
    //     if(Auth::attempt($login,$remember)){
    //         return redirect('account/update');
    //     }else {
    //         return redirect()->back()->withErrors('Email or Password incorrect, please try again!');
    //     }


    //  }
    public function login(UserloginRequest $request)
{
    $login = [
        'email' => $request->email,
        'password' => $request->password,
    ];

    $remember = $request->remember_me ? true : false;

    if (Auth::attempt($login, $remember)) {
        $user = Auth::user();
        if ($user->level == 1) {
            // Redirect admin to admin dashboard
            return redirect()->route('admin.dashboard'); // Make sure this route exists
        } else {
            // Redirect user to frontend view
            return redirect('account/update');
        }
    } else {
        return redirect()->back()->withErrors('Email or Password incorrect, please try again!');
    }
}
     public function store(Request $request)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
    public function logout(Request $request)
   {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/Frontend/frontendlogin');
   }
}
