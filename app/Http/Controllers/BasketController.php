<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\BasketProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BasketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=auth()->user();
        $basket= Basket::where('user_id',auth()->user()->id)->get()->each(function($basket){
            $basket->getProducts;
        });
        return response()->json([
            "status"=>200,
            "basket"=>$basket
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
        $validator = Validator::make($request->all(),
        [
            'product_id'=>"required",
        ]
        );

        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $user=auth()->user();
        
        $nowBasket=Basket::orderBy('created_at',"desc")->first();   

        if(!isset($nowBasket->status) || $nowBasket->status) //Sepet aktif değil işleme devam edildi.
        {
            $nowBasket = Basket::create([
                "user_id"=>$user->id,
                'status'=>false
            ]);
        }

        BasketProduct::create([
            'basket_id'=>$nowBasket->id,
            'product_id'=>$request->product_id,
            'price'=>Product::find($request->product_id)->price,
        ]);

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
        ]);
    }

}

