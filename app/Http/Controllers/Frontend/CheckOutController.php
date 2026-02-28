<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Mail;
use App\Mail\MailNotify;
class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    { if (session()->has('cart')) {
        //Lay session
        $getSession = session()->get('cart');
        $totalPrice = 0;
        foreach ($getSession as $key => $value) {
            $total = $getSession[$key]['price'] * $getSession[$key]['qty'];
            $totalPrice += $total;
            }
        }
        return view('Frontend.checkout',compact('getSession','totalPrice'));
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
    public function quickRegister(Request $request)
    {
        $register = $request->all();
        $file = $request->avatar;

        if(!empty($file)){
            $register['avatar'] = $file->getClientOriginalName();
        }

        $register['password'] = bcrypt($request->password);

        $register['level'] = 0;

        $mail = $register['email'];
        if(User::create($register)){

            if(!empty($file)){
                $file->move('upload/user/avatar',$file->getClientOriginalName());
                if (session()->has('cart')) {
                    //Lay session
                    $getSession = session()->get('cart');
                    $totalPrice = 0;
                    foreach ($getSession as $key => $value) {
                        $total = $getSession[$key]['price'] * $getSession[$key]['qty'];
                        $totalPrice += $total;
                        }
                    }
                    $data = [
                        'subject' => 'Tran Anh Huy',
                        'body' => session()->get('cart'),
                        'totalPay' => $totalPrice,
                    ];
            }
            try {
                Mail::to($mail)->send(new MailNotify($data)); //Mail khach
                return response()->json(['Great check your mail box']);
            }catch (Exception $th){
                var_dump($th);
                return response()->json(['Sorry']);
            }
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
