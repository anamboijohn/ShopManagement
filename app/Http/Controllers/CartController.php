<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Record;
use Illuminate\Http\Request;
use Darryldecode\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{

    public function sell(){
        $items = Cart::getContent();
        $products = Product::all();

        foreach ($items as $item) {
            $product = $products->find($item->id);
            if($product->quantity < $item->quantity || $product->quantity == 0) return back()->with('error', 'CAN\'T SELL: The quantity of '.$product->name.' left is too small ');
            auth()->user()->records()->create([
                'product_id'=> $item->id,
                'product_name'=>$item->name,
                'price' => $item->price,
                'quantity_sold' => $item->quantity,
                'quantity_inStock' => $products->find($item->id)->quantity,
                'quantity'=> $products->find($item->id)->quantity,
                'amount' => $item->price * $item->quantity
            ]);
            $product->quantity -= $item->quantity;
            $product->quantity_sold += $item->quantity;
            $product->save();
        }
        Cart::clear();

        return redirect()->route('dashboard')->with('success', 'Added to sold records');

    }

    public function cartList()
    {
        $cartItems = Cart::getContent();
        // dd($cartItems);
        return view('cart.cart', compact('cartItems'));
    }


    public function addToCart(Request $request)
    {
        Cart::add([
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->image,
            )
        ]);
        session()->flash('success', 'item is Added to Cart Successfully !');

        return back();
    }

    public function updateCart(Request $request)
    {
        Cart::update(
            $request->id,
            [
                'quantity' => [
                    'relative' => false,
                    'value' => $request->quantity
                ],
            ]
        );

        session()->flash('success', 'Item Cart is Updated Successfully !');

        return redirect()->route('cart.list');
    }

    public function removeCart(Request $request)
    {
        Cart::remove($request->id);
        session()->flash('success', 'Item Cart Remove Successfully !');

        return redirect()->route('cart.list');
    }

    public function clearAllCart()
    {
        Cart::clear();

        session()->flash('success', 'All Item Cart Clear Successfully !');

        return redirect()->route('cart.list');
    }

    public function invoice(){
        $items = Cart::getContent();
        return view('products.invoice', ['items'=>$items, 'total'=>Cart::getTotal()]);
    }
}
