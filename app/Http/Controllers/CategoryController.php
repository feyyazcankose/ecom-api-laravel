<?php

namespace App\Http\Controllers;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category= Category::all();
        return response()->json([
            "status"=>200,
            "category"=>$category
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
            'slug'=>"required",
            'banner'=>"required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }


        $category = Category::create([
            "title"=>$request->title,
            "slug"=>$request->slug,
            'banner'=>$request->banner
        ]);

        return response()->json([
            "messages"=>"Kayıt Başarılı",
            "status"=>200,
            "category"=>$category
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
        $category = Category::find($id);

        return response()->json([
            "status"=>200,
            "category"=>$category,
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
            'slug'=>"required",
            'banner'=>"required"
        ]);


        if($validator->fails())
        {
            return response()->json([
                'validation_error'=>$validator->messages(),
            ]);
        }

        $category = Category::find($id)->update([
            "title"=>$request->title,
            "slug"=>$request->slug,
            'banner'=>$request->banner
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
        $category = Category::find($id)->delete();
        $status= $category ? 200 : 401;
        return response()->json([
            "status"=>$status,
        ]);
        
    }
}
