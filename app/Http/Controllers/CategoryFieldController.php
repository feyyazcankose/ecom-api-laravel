<?php

namespace App\Http\Controllers;

use App\Models\CategoryField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryFieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryFields= CategoryField::all();
        return response()->json([
            "status"=>200,
            "category_fields"=>$categoryFields
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
            'category_id'=> "required",
            'type'=>"required",
            'name'=>"required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $categoryField = CategoryField::create([
            "category_id"=>$request->category_id,
            "type"=>$request->type,
            'name'=>$request->name
        ]);

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "category_field"=>$categoryField
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
        $categoryField = CategoryField::find($id);

        return response()->json([
            "status"=>200,
            "category_field"=>$categoryField,
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
            'category_id'=> "required",
            'type'=>"required",
            'name'=>"required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        $categoryField = CategoryField::find($id)->update([
            "category_id"=>$request->category_id,
            "type"=>$request->type,
            'name'=>$request->name
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
        $categoryField = CategoryField::find($id)->delete();
        $status= $categoryField ? 200 : 401;
        return response()->json([
            "status"=>$status,
        ]);
        
    }
}
