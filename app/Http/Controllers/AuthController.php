<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function login(Request $request)
    {
        # code...

       try{

         //attempt the login with the email and the password
         if(Auth::attempt($request->only('email', 'password'))){

            //attempt successful
            $user = Auth::user();
            
            /** @var User $user **/
            //create the token
            $token = $user->createToken('app')->accessToken;

            return response([
                "message"=> "success",
                "token" => $token,
                "user"=> $user
            ], 200);

           

        }

       }catch(Exception $exception){

        //in case there is something wrong with the creation of the token
        return response([
            "message2"=> $exception->getMessage()
        ], 400);
       }

        //wrong credentials
        return response([
            'message' => 'Invalid username/password'
        ], 401);
    }

    /**
     * Testing purposes
     */
    public function getUser()
    {
        
        return Auth::user();
    }
}
