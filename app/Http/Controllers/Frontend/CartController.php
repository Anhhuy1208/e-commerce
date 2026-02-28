<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getsession = session()->get('cart');
        if (session()->has('cart')) {
            //Lay session
            $getSession = session()->get('cart');
            $totalPrice = 0;
            foreach ($getSession as $key => $value) {
                $total = $getSession[$key]['price'] * $getSession[$key]['qty'];
                $totalPrice += $total;

                }
            }
        // dd($getsession);
        // exit;
        return view('Frontend.cart',compact('getsession','totalPrice'));
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
    public function update(Request $request, string $id)
    {
        //
    }
    public function qtyup(Request $request)
    {
        $id = $request->getid;
        if (session()->has('cart')) {
            //Lay session
            $getSession = session()->get('cart');

            foreach ($getSession as $key => $value) {
                if ($id == $value['id']) {
                    $getSession[$key]['qty'] += 1;
                    //Update qty
                    session()->put('cart', $getSession);
                    break;
                }
            }
        }

    }
    public function qtydown(Request $request)
    {
        $id = $request->getid;
        if (session()->has('cart')) {
            //Lay session
            $getSession = session()->get('cart');
            foreach ($getSession as $key => $value) {
                if ($id == $value['id']) {
                    $getSession[$key]['qty'] -= 1;
                    //Update qty
                    session()->put('cart', $getSession);
                    break;
                }
            }
        }
    }
    public function deletecart(Request $request)
    {
        $id = $request->getid;
        if (session()->has('cart')) {
            //Lay session
            $getSession = session()->get('cart');
            echo "<pre>";
            var_dump($getSession);

            foreach ($getSession as $key => $value) {
                if ($id == $value['id']) {
                    echo $id;
                    unset($getSession[$key]);
                    reset($getSession);
                    session()->put('cart', $getSession);
                    break;
                }
            }

        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
