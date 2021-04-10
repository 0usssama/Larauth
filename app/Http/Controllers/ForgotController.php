<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\PasswordResetMail;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ForgotRequest;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;

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
        Mail::to("email@email.com")->send(new PasswordResetMail("http://127.0.0.1:8002/reset/" . $token));
       
        try{
            //get latest token reset

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

    public function reset(ResetPasswordRequest $request)
    {
        # code...
        $token = $request->input("token");

        if (!$passwordResets = DB::table('password_resets')->where("token", $token)->first()) {
            # code...

            return response([
                "message"=> "Invalid token!"
            ], 400);
        }

        if (!$user = User::where("email", $passwordResets->email)->first()) {
            # code...
            return response([
                "message"=> "User doesn't existe!"
            ], 400);
        }        


        $user->password = Hash::make($request->input("password"));
        $user->save();

        return response([
            "message"=> "success"
        ]);
    }
}
