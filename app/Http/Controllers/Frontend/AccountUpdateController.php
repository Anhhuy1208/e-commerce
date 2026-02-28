<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserloginRequest;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UserRequest;
class AccountUpdateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Frontend.accountupdate');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

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
    public function edit()
    {

           $userid = Auth::user()->id;
           $account = User::where('id',$userid)->first();
            // dd($account);
            // $account = User::where('id',$userid)->get()->toArray();
            // $account = $account[0];


           return view('Frontend.accountupdate', compact('account'));



    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request)
    {
        $userid = Auth::user()->id;
        $user = User::findOrFail($userid);

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
        $data['level'] = 0;
        // dd($data);
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
}
