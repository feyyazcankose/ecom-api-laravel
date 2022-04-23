<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user=Auth::user();

        $likes= Like::where('user_id',$user->id)->get();
        return response()->json([
            "status"=>200,
            "Likes"=>$likes
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

        $user=Auth::user();

        $validator = Validator::make($request->all(),[
            'product_id'=> "required",
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $like = Like::create([
            "product_id"=>$request->product_id,
            "user_id"=>$user->id,
        ]);

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "like"=>$like
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
        $user=Auth::user();

        $like = Product::find($id)->getLikes->first()->delete();
        $status= $like ? 200 : 401;
        return response()->json([
            "status"=>$status,
            "like"=>$like,

        ]);
        
    }
}


