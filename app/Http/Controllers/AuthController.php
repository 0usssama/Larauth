<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function index()
    {
       //for testing purposes
        return view("register");
    }
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

    public function register(RegisterRequest $request)
    {
     
        try{
           
            $user = User::create([

                "first_name"=> $request->input("first_name"),
                "last_name"=> $request->input("last_name"),
                "email"=> $request->input("email"),
                "password"=> Hash::make($request->input("password"))
        
        
            ]);
            return $user;
        }catch(Exception $exception){

            return response([
                "message"=> $exception->getMessage()
            ], 400);
        }
    }
}
