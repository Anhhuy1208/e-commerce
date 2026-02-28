<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogComment;
use App\Models\comment;
use App\Models\commentblog;
use App\Models\rateblog;
use Auth;
use Illuminate\Http\Request;

class FrontendShowBlogController extends Controller
{
    public function index()
    {
        return view('Frontend.showblog');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Frontend.showblog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function rateaJax(Request $request)
    {
        var_dump($request->all());
        $data = $request->all();
        if(rateblog::create($data)){
            echo "Them danh gia thanh cong";
        }else{
            echo "Them danh gia that bai";
        }
    }
    public function commentAjax(Request $request)
    {
            // var_dump($request->all());
            $data = $request->all();

        if($x = commentblog::create($data)){
            // echo "Them binh luan thanh cong";
            return response()->json(['data' => $x]);

        }else{
            return response()->json(['data' => "Them binh luan that bai"]);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $showfrontendblog = Blog::where('id',$id)->get()->toArray();
        $showfrontendblog = $showfrontendblog[0];
        $userid = Auth::user()->id;
        // dd($showfrontendblog);
        $user = Blog::find($id);
        $previous = Blog::where('id','<',$user->id)->max('id');
        $next = Blog::where('id','>',$user->id)->min('id');
        $average = rateblog::where('id_blog',$id)->avg('rate');



        $blogcomment = commentblog::where('id_blog',$id)->get()->toArray();


        return view('Frontend.showblog',compact('showfrontendblog','previous','next','userid','average','blogcomment'));
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
