<?php

namespace App\Http\Controllers;

use App\Customs\Upload;
use App\Enums\UploadEnum;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products= Product::all()->each(function($product){
            $product->getCategory;
        });
        return response()->json([
            "status"=>200,
            "products"=>$products
        ]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([
            "status"=>200,
            "category"=>Category::all(["id","title"])
        ]);
        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'title'=> "required",
            'category_id'=>"required",
            'descirptions'=>"required",
            'price'=>"required",
            'quantity'=>"required",
            'path'=>"required",
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        if($request->has('path')){

                $upload = new Upload($request->path,"product",UploadEnum::PRODUCT);
                $path=$upload->upload();
               
        }
        $product = Product::create([
            "title"=>$request->title,
            "category_id"=>$request->category_id,
            "descirptions"=>$request->descirptions,
            "quantity"=>$request->quantity,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
            'path'=>$path,
        ]);

        


        

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "product"=>$product
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        $product = Product::find($id);

        return response()->json([
            "status"=>200,
            "product"=>$product,
        ]);
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

        // dd($request);
       
        $validator = Validator::make($request->all(),[
            'title'=> "required",
            'category_id'=>"required",
            'descirptions'=>"required",
            'price'=>"required",
            'quantity'=>"required",
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $product = Product::find($id)->update([
            "title"=>$request->title,
            "category_id"=>$request->category_id,
            "descirptions"=>$request->descirptions,
            'price'=>$request->price,
            'quantity'=>$request->quantity,
        ]);

        return response()->json([
            "status"=>200,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $product = Product::find($id)->delete();
        $status= $product ? 200 : 401;
        return response()->json([
            "status"=>$status,
        ]);
        
    }
    
}
