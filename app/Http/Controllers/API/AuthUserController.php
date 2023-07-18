<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthUserController extends Controller
{
    public function register(Request $request){
        $validators = Validator($request->all() , [
            'email' => 'required|email|unique:admins,email',
            'password' => 'required|min:6',
        ]);

        if (! $validators->fails()) {

            $admins = new Admin();
            $admins->email = $request->get('email');
            $admins->password = Hash::make($request->get('password'));

            $isSaved = $admins->save();

            if($isSaved){
                return response()->json([
                    'status' => true,
                    'message' => 'Created Account is Successfully',
            ], 200);


            }else{
                return response()->json([
                    'status' => false,
                    'message' => 'Created Account is Failed',
                ], 400);
            }



        }else {
            return response()->json([
                'status' => false,
                'message' => $validators->getMessageBag()->first()
            ], 400);
        }
    }

    public function login(Request $request){

        $validators = Validator($request->all() , [
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:6',
        ]);

        if (! $validators->fails()) {
            $admins = Admin::where('email' ,'=', $request->get('email'))->first();

            if(Hash::check($request->get('password') , $admins->password)){
               $token = $admins->createToken('admin-api');
               $admins->setAttribute('token' , $token->accessToken);
               return $token;

               return response()->json([
                'status' => true,
                'message' => 'Login is Successfully',
        ], 200);


        }else{
            return response()->json([
                'status' => false,
                'message' => 'Login is Failed',
            ], 400);

            }

        }else {
            return response()->json([
                'status' => false,
                'message' => $validators->getMessageBag()->first()
            ], 400);
        }


    }

    public function logout(Request $request){
        return response()->view('cms.auth.login' , compact('guard'));
    }

    public function forgetPassword(Request $request){
        return response()->view('cms.auth.login' , compact('guard'));
    }


}
