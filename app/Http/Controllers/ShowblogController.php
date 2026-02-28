<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class ShowblogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogshow = Blog::all();
        return view('Admin.showblog',compact('blogshow'));
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
        $blogedit = Blog::where('id',$id)->get();
        $blogedit->toArray();

        return view('Admin/blogedit',compact('blogedit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Blog::where('id',$id)->update([
            'name'=> $request->name,
            'image'=>$request->image,
            'description'=>$request->description,
            'content'=>$request->content,
        ]);
        echo "Update blog thanh cong";
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Blog::destroy($id);
        echo "Xoa blog thanh cong";
    }
}
