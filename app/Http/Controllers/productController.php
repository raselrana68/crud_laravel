<?php

namespace App\Http\Controllers;
use App\Product;
use Illuminate\Http\Request;

class productController extends Controller
{   
    
    public function __construct(){
       $this->middleware('auth');
    }

    function addProductView(){
        $products = Product::paginate(10);
        return view('product/view', compact('products'));
    }

    function addProductInsert(Request $request){
        $request->validate([
            'product_name'=> 'required',
            'product_description'=>'required',
            'product_price'=> 'required | numeric',
            'product_quantity'=> 'required | numeric',
            'alert_quantity'=> 'required | numeric',
        ]);

        Product::insert([
            'product_name'=>$request->product_name,
            'product_description'=>$request->product_description,
            'product_price'=>$request->product_price,
            'product_quantity'=>$request->product_quantity,
            'alert_quantity'=>$request->alert_quantity,
        ]);
        return back()->with('status','Product Added Successfully');
    }

    function deleteProduct($product_id){
        Product::find($product_id)->delete();
        return back()->with('delete','Product Deleted Successfully');
    }

    function editProduct($product_id){
        $product_info = Product::findOrFail($product_id);
        return view('product/edit',compact('product_info'));
    }

    function editProductInsert(Request $request){
        //print_r($request->all());
        Product::find($request->id)->update([
            'product_name'=>$request->product_name,
            'product_description'=>$request->product_description,
            'product_price'=>$request->product_price,
            'product_quantity'=>$request->product_quantity,
            'alert_quantity'=>$request->alert_quantity,
        ]);
        
        return back()->with('status','Product Updated Successfully.');
    }
}
