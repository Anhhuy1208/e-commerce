<?php

namespace App\Http\Controllers;

use App\Models\country;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CountryRequest;

class CountryController extends Controller
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
        $showblog = country::all();
        return view('Admin.country',compact('showblog'));
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

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $showblog = country::where('id',$id)->get('name');
        $showblog->toArray();

        return view('Admin.editblog',compact('showblog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CountryRequest $request, string $id)
    {
        country::where('id',$id)->update([
            'name'=> $request->name,
        ]);
        echo "Update blog thanh cong";

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        country::destroy($id);
        echo "Xoa blog thanh cong";

    }
}
