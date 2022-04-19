<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'surname'=>'required',
            'email'=>'required| |email',
            'password'=>'required|min:8',
        ]);
       


        if($validator->fails())
        {
            return response()->json([
                'validator_error'=>$validator->messages(),
            ]);
        }


        $user = User::create([
            'name'=>$request->name,
            'surname'=>$request->surname,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);



        $token=$user->createToken($user->email.'_Token')->plainTextToken;

        return response()->json([
            'status'=>200,
            'email'=>$user->email,
            'username'=>$user->full_name,
            'token'=>$token,
            'message'=>"Kayıt başarılı.",
        ]);


    }


    public function login(Request $request){
      

        $validator = Validator::make($request->all(),[
            'email'=>'required|email',
            'password'=>'required|min:8',
        ]);



        if($validator->fails())
        {
            return response()->json([
                'validator_error'=>$validator->messages(),
            ]);
        }



        $user = User::where('email',$request->email)->first();

        if(isset($user->password)!=null){


            if(Hash::check($request->password,$user->password)){

                $token=$user->createToken($user->email.'_Token')->plainTextToken;

                return response()->json([
                    'status'=>200,
                    'email'=>$user->email,
                    'username'=>$user->full_name,
                    'token'=>$token,
                    'message'=>"Kayıt başarılı.",
                ]);

            }

            return response()->json([
                'status'=>401,
                'message'=>"Şifre hatalı!",
            ]);
        }

        
        return response()->json([
            'status'=>401,
            'message'=>"Sistemde mail adresi kayıtlı değil!",
        ]);


        

    }


    public function logout(){
        
        auth()->user()->tokens()->delete();
        return response()->json([
            'status'=>200,
            'message'=>"Başarılı",
        ]);

    }
}
