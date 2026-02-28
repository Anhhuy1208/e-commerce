<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('Frontend.search');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Frontend.searchadvance');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function search(Request $request)
    {
        $search = $request->search;
        $product = Product::where('name', 'like', "%$search%")->get()->toArray();
        //  dd($product);
        //  exit;
        return view('Frontend.search', compact('product'));
    }
    public function searchadvance(Request $request)
    {
        //   $searchadvance = $request->all;
        $name = $request->name;
        $price = json_decode($request->price);
        $category = $request->id_category;
        $brand = $request->id_brand;
        $status = $request->status;

        $product = Product::query();

        if (!empty($name)) {
            $product->where('name', 'like', "%$name%");
        }

        if (!empty($price) && is_array($price)) {
            $product->whereBetween('price', [$price[0], $price[1]]);
        }

        if (!empty($category)) {
            $product->where('id_category', $category);
        }

        if (!empty($brand)) {
            $product->where('id_brand', $brand);
        }

        if (!empty($status)) {
            $product->where('status', $status);
        }

        $searchproduct = $product->orderBy('name')->paginate(5);

        return view('Frontend.searchadvance', compact('searchproduct'));
    }

public function searchprice(Request $request){
$price = $request->price;
$data = Product::whereBetween('price', [$price[0], $price[1]]);
dd($data);
header('Content-Type: application/json');
echo json_encode($data);

return view('Frontend.searchadvance');
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
