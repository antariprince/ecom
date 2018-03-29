<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Session;
use File;

class ProductsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index',['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create',['products' => Product::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'image' => 'required',
            'price' => 'required'
        ]);

        $featured = $request->image;
        $featured_new_name = time().$featured->getClientOriginalName();
        $featured->move('uploads/products', $featured_new_name);
        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => 'uploads/products/'.$featured_new_name
        ]);
        $product->save();
        Session::flash('success','Product created successfully');
        return redirect()->route('products.index');
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
        //dd(Product::find($id));
        return view('admin.products.edit')->with('product', Product::find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'name' => 'required',
            'description' => 'required',
            'price' => 'required'
        ]);

        $p = Product::find($id);
        if($request->hasFile('image')){
            $featured = $request->image;
            $featured_new_name = time().$featured->getClientOriginalName();
            $featured->move('uploads/products', $featured_new_name);
            $p->image = 'uploads/products/'.$featured_new_name;

        }

        $p->name = $request->name;
        $p->description = $request->description;
        $p->price = $request->price;

        $p->save();
        Session::flash('success','Product updated successfully');
        return redirect()->route('products.index');
        //return redirect()->route('product.show',['product' => $p->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = Product::find($id);
        $p->delete();
        File::delete($p->image);
        Session::flash('success','Product deleted successfully');
        return redirect()->route('products.index');
    }
}
