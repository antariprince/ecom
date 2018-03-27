<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Mail;
use Session;
use Stripe\Stripe;
use Stripe\Charge;

class CheckoutController extends Controller
{
	public function index(){
		return view('checkout');
	}

	public function pay(){
		Stripe::setApiKey("sk_test_mi1JsiHETd8HuD9ddegL8zW3");
		$token = request()->stripeToken;

		$charge = Charge::create(array(
		  "amount" => Cart::getTotal() * 100,
		  "currency" => "usd",
		  "description" => "udemy course practice selling books",
		  "statement_descriptor" => "Custom descriptor",
		  "source" => $token,
		));

		//dd('your card was charged successfully');
		Session::flash('success', 'purchase successfull, wait for our email.');

		Mail::to(request()->stripeEmail)->send(new \App\Mail\CheckoutEmail);

		Cart::clear();

		return redirect('/');
	}
}
