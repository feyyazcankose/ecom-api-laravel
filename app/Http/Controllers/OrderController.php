<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $orders= Order::where('user_id',$user->id);
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

        $validator = Validator::make($request->all(),[
            'product_id'=>"required",
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $order = Order::create([
            "product_id"=>$request->product_id,
            'user_id'=>$user->id
        ]);

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "order"=>$order
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
        $order = Order::find($id);

        return response()->json([
            "status"=>200,
            "order"=>$order,
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
        $order = Order::find($id)->delete();
        $status= $order ? 200 : 401;
        return response()->json([
            "status"=>$status,
        ]);
        
    }
}
