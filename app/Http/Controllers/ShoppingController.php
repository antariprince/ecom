<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Cart;

class ShoppingController extends Controller
{
    public function add_to_cart(){
    	//dd(request()->all());
    	$pdt = Product::find(request()->pdt_id);
    	$cart = Cart::add([
    		'id' => $pdt->id,
    		'name' => $pdt->name,
    		'quantity' => request()->qty,
    		'price' => $pdt->price,
            'attributes' => ['image' => request()->pdt_image]
    	]);
    	//dd(Cart::getContent());

    	return redirect()->route('cart');
    }

    public function remove_from_cart($id){
        //dd($id);
        Cart::remove($id);
        return redirect()->back();
    }

    public function increment($id){
        $item = Cart::get($id);
        Cart::update($id,[
            'quantity' => $item->quantity++
        ]);
        return redirect()->back();
    }

    public function decrement($id){
        $item = Cart::get($id);
        Cart::update($id,[
            'quantity' => $item->quantity--
        ]);
        return redirect()->back();
    }

    public function cart(){
        //Cart::clear();
    	return view('cart');
    }

    public function rapid_add($id){

        $pdt = Product::find($id);
        $pdtSess = Cart::get($id);

        
        if(count($pdtSess) > 0){
            Cart::update($id,[
            'quantity' => $pdtSess->quantity++
            ]);
        }
        else{
           $cart = Cart::add([
            'id' => $pdt->id,
            'name' => $pdt->name,
            'quantity' => 1,
            'price' => $pdt->price,
            'attributes' => ['image' => $pdt->image]
        ]);
        }
        return redirect()->route('cart');
    }

    
}
