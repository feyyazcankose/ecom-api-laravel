<?php

namespace App\Http\Controllers;

use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $card= Card::where("user_id",auth()->user()->id)->get();
        return response()->json([
            "status"=>200,
            "card"=>$card
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
            'mounth'=>"required",
            'year'=>"required",
            'card_number'=>"required|min:16|max:16",
            'cvc'=>"required|min:3|max:3"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        $request->request->add(["user_id"=>auth()->user()->id]);
        // dd($request);
        $card = Card::create($request->all()); 

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "card"=>$card
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
            'mounth'=>"required",
            'year'=>"required",
            'card_number'=>"required|min:16|max:16",
            'cvc'=>"required|min:3|max:3"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        $request->request->add(["user_id"=>auth()->user()->id]);
        // dd($request);
        $card = Card::where("id",$id)->update($request->all()); 

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
        $card = Card::find($id)->delete();
        $status= $card ? 200 : 401;
        return response()->json([
            "status"=>$status,
        ]);
        
    }
}
