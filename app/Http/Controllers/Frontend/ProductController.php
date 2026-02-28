<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Auth;
use Illuminate\Http\Request;
use Intervention\Image\Laravel\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userid = Auth::id();
        $updateproduct = Product::where('id_user', $userid)->get()->toArray();
        // $myproductimage = $updateproduct->hinhanh ? json_decode($updateproduct->hinhanh, true) : [];
        // $myproductimage = json_decode($updateproduct->hinhanh,true);


        return view('Frontend.product', compact('updateproduct'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Frontend.addproduct');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {

        $data = [];
        if ($request->hasfile('hinhanh')) {
            foreach ($request->file('hinhanh') as $xx) {
                $image = Image::read($xx);

                $name = $xx->getClientOriginalName();
                $name_2 = "hinh50_" . $xx->getClientOriginalName();
                $name_3 = "hinh200_" . $xx->getClientOriginalName();

                $path = public_path('upload/' . $name);
                $path2 = public_path('upload/' . $name_2);
                $path3 = public_path('upload/' . $name_3);

                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);

                $data[] = $name;
            }
        }

        // dd($data);
        // exit;

        $product = $request->all();
        $product['id_user'] = Auth::id();
        $product['hinhanh'] = json_encode($data);


        if (Product::create($product)) {
            return redirect()->back()->with('success', _('Update product sucess'));
        } else {
            return redirect()->back()->withErrors(('Update product error'));
        }

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
        $updateproduct = Product::where('id', $id)->first();
        // $getImage = json_decode($updateproduct->hinhanh,true);
        $getImage = $updateproduct->hinhanh ? json_decode($updateproduct->hinhanh, true) : [];
        // dd($getImage);
        // exit;
        return view('Frontend.updateproduct', compact('updateproduct', 'getImage'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->all();
        $deleleimage = $request->hinhxoa;
        $newimage = [];
        if ($request->hasfile('hinhanh')) {
            foreach ($request->file('hinhanh') as $xx) {
                $image = Image::read($xx);

                $name = $xx->getClientOriginalName();
                $name_2 = "hinh50_" . $xx->getClientOriginalName();
                $name_3 = "hinh200_" . $xx->getClientOriginalName();

                $path = public_path('upload/product' . $name);
                $path2 = public_path('upload/product' . $name_2);
                $path3 = public_path('upload/product' . $name_3);

                $image->save($path);
                $image->resize(50, 70)->save($path2);
                $image->resize(200, 300)->save($path3);

                $newimage[] = $name;
            }
        }


        $imageorigin = json_decode($product->hinhanh, true);

        foreach ($imageorigin as $key => $value) {
            if (in_array($value, $deleleimage)) {

                unset($imageorigin[$key]);
            }
        }

        $updateimage = array_merge($newimage, $imageorigin);
        reset($updateimage);


        // dd($imageorigin);
        // exit;
        if (count($updateimage) > 3) {
            return redirect()->back()->withErrors(('Update image product error'));

        }
        //  dd($updateimage);
        // exit;

        $data['hinhanh'] = json_encode($updateimage);
        $data['id_user'] = Auth::id();

        if ($product->update($data)) {
            return redirect()->back()->with('success', _('Update product success'));
        } else {
            return redirect()->back()->withErrors(('Update product error'));
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Product::destroy('id', $id)) {
            return redirect()->back()->with('success', _('Delete product sucess'));
        } else {
            return redirect()->back()->withErrors(('Delete product error'));
        }
    }
}

