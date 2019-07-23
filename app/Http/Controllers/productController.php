<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;
use Image;
use Carbon\Carbon;

class productController extends Controller
{   
    public function __construct(){
        $this->middleware('auth'); 
    }
    
    function addProductView(){
        $products = Product::paginate(10);
        $deletedProducts = Product::onlyTrashed()->get();

        return view('product/view', compact('products','deletedProducts'));

    }

    function addProductInsert(Request $request){
        
        $request->validate([
            'product_name'=> 'required',
            'product_description'=>'required',
            'product_price'=> 'required | numeric',
            'product_quantity'=> 'required | numeric',
            'alert_quantity'=> 'required | numeric',
        ]);

        $last_inserted_id = Product::insertGetId([
            'product_name'=>$request->product_name,
            'product_description'=>$request->product_description,
            'product_price'=>$request->product_price,
            'product_quantity'=>$request->product_quantity,
            'alert_quantity'=>$request->alert_quantity,
            'created_at'=> Carbon::now(),
        ]);

         if($request->hasFile('product_image')){
            $photo_to_upload = $request->product_image;
            $filename = $last_inserted_id.".".$photo_to_upload->getClientOriginalExtension();
            Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
            Product::find($last_inserted_id)->update([
                'product_image' => $filename
            ]);
        }
        return back()->with('status','Product Added Successfully');
    }

    function deleteProduct($product_id){
        Product::find($product_id)->delete();
        return back()->with('delete','Product Deleted Successfully');
    }

    function forceDeleteProduct($product_id){
        //echo Product::onlyTrashed()->find($product_id)->product_image;

        if( Product::onlyTrashed()->find($product_id)->product_image == 'default_product_photo.jpg'){
            Product::onlyTrashed()->find($product_id)->forceDelete();
        }else{
            $delete_this_file = Product::onlyTrashed()->find($product_id)->product_image;
            unlink(base_path('public/uploads/product_photos/'.$delete_this_file));
            Product::onlyTrashed()->find($product_id)->forceDelete();
        }
        return back()->with('success1','Product has permanently Deleted');
    }

    function editProduct($product_id){
        $product_info = Product::findOrFail($product_id);
        return view('product/edit',compact('product_info'));
    }
    
    function restoreProduct($product_id){
        Product::onlyTrashed()->where( 'id' , $product_id)->restore();
        return back()->with('success','Product restored succesfully');
    }

    function editProductInsert(Request $request){
        //print_r($request->all());
        
        if($request->hasFile('product_image')){

            if(Product::find($request->id)->product_image == 'default_product_photo.jpg'){
                $photo_to_upload = $request->product_image;
                $filename = $request->id.".".$photo_to_upload->getClientOriginalExtension();
                Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
                Product::find($request->id)->update([
                    'product_image' => $filename
                ]);
            }else{

                $delete_this_file = Product::find($request->id)->product_image ;
                unlink(base_path('public/uploads/product_photos/'.$delete_this_file));

                $photo_to_upload = $request->product_image;
                $filename = $request->id.".".$photo_to_upload->getClientOriginalExtension();
                Image::make($photo_to_upload)->resize(400,450)->save(base_path('public/uploads/product_photos/'.$filename));
                Product::find($request->id)->update([
                    'product_image' => $filename
                ]);
            }
        }
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
