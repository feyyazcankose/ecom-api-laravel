<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function index(){
        $user=auth()->user();
        
        $data=[
            "name"=>$user->full_name,
            "role"=>$user->role_id->title(),
            "email"=>$user->email
        ];

        return response()->json($user);
    }

    public function update(Request $request){
        $user=auth()->user();
        $validator = Validator::make($request->all(),[
            "name"=>"required",
            "surname"=>"required",
            "email"=>"required",
        ]);

        User::find($user->id)->update($request->all());
        return response()->json([
            "status"=>200,
            "message"=>"Successfully"
        ]);
    }
  
}
