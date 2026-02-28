<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;

class FrontendUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */



    public function index()
    {
        return view('Frontend.frontendprofile');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

       return view('Frontend.frontendprofile');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {



        $data = $request->all();
        $file = $request->avatar;

        if(!empty($file)){
            $data['avatar'] = $file->getClientOriginalName();
        }

        $data['password'] = bcrypt($request->password);

        $data['level'] =0;

        if(User::create($data)){

            if(!empty($file)){

                $file->move('upload/user/avatar',$file->getClientOriginalName());
            }
            return redirect()->back()->with('success',_('Update profile sucess'));
        }else {
            return redirect()->back()->withErrors(('Update profile error'));
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
    public function destroy(string $id)
    {
        //
    }
}
