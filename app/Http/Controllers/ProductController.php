<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = auth()->user()->products()->latest();
        return view('products.index', ['products'=>$products->filter(request(['search']))->paginate(30)->withQueryString()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'=>['required', 'max:255', Rule::unique('products')],
            'description'=>['required', 'max:500'],
            'price'=>['required', 'max:255'],
            'quantity'=>['required', 'max:255'],
        ]);

        auth()->user()->products()->create($attributes);

        return redirect()->route('dashboard')->with('success', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        return view('products.edit', ['product'=>Product::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $attributes = $request->validate([
            'name'=>['required', 'max:255'],
            'description'=>['required', 'max:500'],
            'price'=>['required', 'max:255'],
            'quantity'=>['required', 'max:255'],
        ]);

        $product->update($attributes);

        return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function dashboard(){
        $products = auth()->user()->products()->latest();
            return view('dashboard', ['products'=>$products->filter(request(['search']))->paginate(30)->withQueryString()]);
    }
}
