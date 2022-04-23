<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons= Coupon::all();
        return response()->json([
            "status"=>200,
            "coupons"=>$coupons
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
            'product_id'=> "required",
            'code'=>"required|unique:coupons",
            'active'=>"required",
            'discount'=>"required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $coupon = Coupon::create([
            "product_id"=>$request->product_id,
            "code"=>$request->code,
            'active'=>$request->active,
            'discount'=>$request->discount,
        ]);

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "coupon"=>$coupon
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
        $coupon = Coupon::find($id);

        return response()->json([
            "status"=>200,
            "coupon"=>$coupon,
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
            'product_id'=> "required",
            'code'=>"required",
            'active'=>"required",
            'discount'=>"required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        $coupon = Coupon::find($id)->update([
            "product_id"=>$request->product_id,
            "code"=>$request->code,
            'active'=>$request->active,
            'discount'=>$request->discount,
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
        $coupon = Coupon::find($id)->delete();
        $status= $coupon ? 200 : 401;
        return response()->json([
            "status"=>$status,
        ]);
        
    }
}
