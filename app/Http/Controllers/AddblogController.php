<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CountryRequest;

class AddblogController extends Controller
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
          return view('Admin.addblog');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.addblog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CountryRequest $request)
    {
        $datainsert = $request->all();
        if(country::create($datainsert)){
            echo "Them blog thanh cong";
        }else{
            echo "Them blog that bai";
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
