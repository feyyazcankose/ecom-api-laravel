<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Basket;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $orders= Order::all()->each(function ($order){
            $order->getBasket->getProducts;
            $order->getAdres;
        });
        return response()->json([
            "status"=>200,
            "orders"=>$orders
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
        $user = auth()->user();

        $validator = Validator::make($request->all(),
        [
            'adres_id'=>"required",
        ]);

        $nowBasket=Basket::orderBy('created_at',"desc")->first();

        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $order = Order::create(
            [
                "basket_id"=>$nowBasket->id,
                "adres_id"=>$request->adres_id,
                'user_id'=>$user->id,
                'status'=> \App\Enums\OrderEnum::WAIT,
            ]
        );

        Basket::find($nowBasket->id)->update([
            'status'=>true
        ]);

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "order"=>$order
        ]);
    }

  






    
}
