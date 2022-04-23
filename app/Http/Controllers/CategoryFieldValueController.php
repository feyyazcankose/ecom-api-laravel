<?php

namespace App\Http\Controllers;

use App\Models\CategoryFieldValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryFieldValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryFieldValues= CategoryFieldValue::all();
        return response()->json([
            "status"=>200,
            "category_field_values"=>$categoryFieldValues
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
            'category_field_id'=> "required",
            'product_id'=>"required",
            'value'=>"required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $categoryField = CategoryFieldValue::create([
            "category_field_id"=>$request->category_field_id,
            "product_id"=>$request->product_id,
            'value'=>$request->value
        ]);

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "category_field_value"=>$categoryField
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
        $categoryFieldValue = CategoryFieldValue::find($id);

        $status= $categoryFieldValue ? 200 : 401;

        return response()->json([
            "status"=>$status,
            "category_field_value"=>$categoryFieldValue,
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
            'category_field_id'=> "required",
            'product_id'=>"required",
            'value'=>"required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        $categoryFieldValue = CategoryFieldValue::find($id)->update([
            "category_field_id"=>$request->category_field_id,
            "product_id"=>$request->product_id,
            'value'=>$request->value
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
        $categoryField = CategoryFieldValue::find($id)->delete();
        $status= $categoryField ? 200 : 401;
        return response()->json([
            "status"=>$status,
        ]);
        
    }
}
