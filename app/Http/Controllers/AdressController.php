<?php

namespace App\Http\Controllers;

use App\Models\Adres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AdressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $adres= Adres::where('user_id',auth()->user()->id)->get();
        return response()->json([
            "status"=>200,
            "adres"=>$adres
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
            'adres'=> "required",
            'title'=> "required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        $user=auth()->user();

        $request->request->add(["user_id"=>$user->id]);

        $adres = Adres::create($request->all());

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "adres"=>$adres
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
        $adres = Adres::find($id);

        return response()->json([
            "status"=>200,
            "adres"=>$adres,
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
            'adres'=> "required",
            'title'=> "required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        $user=auth()->user();

        $request->request->add(["user_id"=>$user->id]);

        $adres = Adres::find($id)->update($request->all());

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
        $adres = Adres::find($id)->delete();
        $status= $adres ? 200 : 401;
        return response()->json([
            "status"=>$status,
        ]);
        
    }
}
