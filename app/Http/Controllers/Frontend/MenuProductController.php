<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MenuProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getsession = session()->get('cart');
        if (session()->has('cart')) {
            //Lay session
            $totalProduct = 0;
            $getSession = session()->get('cart');

            foreach ($getSession as $key => $value) {
                $totalProduct = $getSession[$key]['qty'];
                }
            }
        // session()->flush();
        $display = Product::orderBy('created_at', 'desc')->take(6)->get()->toArray();

        // dd($display);
        return view('Frontend.productmenu', compact('display'));

    }
    public function addToCart(Request $request)
    {
        $array = [];
        $id = $request->getid;
        $array = Product::where('id', $id)->first()->toArray();
        $array['qty'] = 1;

        $check = 1;
        //Kiem tra co session khong
        if (session()->has('cart')) {
            //Lay session
            $getSession = session()->get('cart');

            foreach ($getSession as $key => $value) {
                if ($id == $value['id']) {
                    $getSession[$key]['qty'] += 1;
                    //Update cart
                    session()->put('cart', $getSession);
                    $check = 0;
                    break;
                }
            }
        }
        if ($check == 1)  {
                //Dua mang vao session
                session()->push('cart', $array);
            }
            return response()->json(['success' => 'Add product to your cart succsessfully']);
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
