<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Requests\ForgotRequest;
use Exception;
use Illuminate\Support\Facades\DB;

class ForgotController extends Controller
{
    //

    public function forgot(ForgotRequest $request)
    {

        $email = $request->input("email");

        if(User::where("email", $email)->doesntExist()){

            return response([
                "message"=> "User doesn't exist!"
            ], 404);
        }
        
        //create special token for reset
        $token = Str::random(10);
       
        try{
            DB::table('password_resets')->insert([
                "email"=> $email, 
                "token"=> $token
            ]);

            //sending email


            return response([
                "message"=> "Check your email"
            ], 200); 


        }catch(Exception $exception){

            return response([
                "message"=> $exception->getMessage()
            ], 400);
        }


        
    }
}
