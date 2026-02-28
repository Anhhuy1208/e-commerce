<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserRequest;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        return view('Admin.user');


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
    public function update(UserRequest $request)
    {

        $userId = Auth::id();

        $user = User::findOrFail($userId);

        $data = $request->all();
        $file = $request->avatar;

        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }
        if($data['password']){
            $data['password'] = bcrypt($data['password']);
        }else{
            $data['password'] = $user->password;
        }

        if($user->update($data)){
            if(!empty($file)){

                $file->move('upload/user/avatar',$file->getClientOriginalName());
            }
            return redirect()->back()->with('success',_('Update profile sucess'));
        }else {
            return redirect()->back()->withErrors(('Update profile error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
      public function __invoke(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('Admin/user');
    }
}
