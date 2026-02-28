<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Mail;
use Auth;
class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {


        if (session()->has('cart')) {
            //Lay session
            $getSession = session()->get('cart');
            $totalPrice = 0;
            foreach ($getSession as $key => $value) {
                $total = $getSession[$key]['price'] * $getSession[$key]['qty'];
                $totalPrice += $total;
                }
            }
        // Cac truong trong session se tuong ung voi cac value o $data
        $data = [
            'subject' => 'Tran Anh Huy',
            'body' => session()->get('cart'),
            'totalPay' => $totalPrice,
        ];
        $idmail =  Auth::id();
        $mail = User::where('id', $idmail)->get('email');
        // dd($mail);


        try {
            Mail::to($mail)->send(new MailNotify($data)); //Mail khach
            return response()->json(['Great check your mail box']);
        }catch (Exception $th){
            var_dump($th);
            return response()->json(['Sorry']);
        }
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
