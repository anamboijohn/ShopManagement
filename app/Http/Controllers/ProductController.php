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
            'price'=>['required', 'numeric'],
            'quantity'=>['required', 'integer', 'numeric'],
            'exp' =>['required', 'date']
        ]);
        $attributes['stocked_at'] = now();
        $attributes['updated_at'] = now();
        auth()->user()->products()->create($attributes);


        return redirect()->route('dashboard')->with('success', 'Product added successfully');
    }


    public function stock(Product $product){
        $attributes = request()->validate([
            'quantity'=>['required', 'integer', 'numeric'],
            'exp' =>['required', 'date']
        ]);
        $added = $attributes['quantity'];
        $attributes['quantity'] += $product->quantity;
        $attributes['stocked_at'] = now();

        $product->update($attributes);


        return redirect()->route('dashboard')->with('success', 'You have successfully added '.$added. ' ' .$product->name.'s to stock!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function notice(){
        $products = auth()->user()->products()->whereBetween('exp', [now(), now()->addMonths(3)]);

        return view('products.notice', ['products'=>$products->filter(request(['date']))->paginate()->withQueryString()]);
    }

    public function show(Product $product)
    {

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
            'price'=>['required', 'numeric',],
            'quantity'=>['required', 'integer', 'numeric'],
            'exp' =>['required', 'date']
        ]);

        $attributes['updated_at'] = now();
        $attributes['stocked_at'] = now();
        $product->update($attributes);

        return redirect()->route('dashboard')->with('success', 'Product updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'product Deleted Successfully');
    }


    public function dashboard(){
        $products = auth()->user()->products()->latest();
            return view('dashboard', ['products'=>$products->filter(request(['search']))->paginate(30)->withQueryString()]);
    }
}
