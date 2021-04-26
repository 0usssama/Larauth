<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;

use Illuminate\Database\Eloquent\ModelNotFoundException as ModelNotFoundException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //
        try {
            //code...
            $post = Post::create([
                "title"=> $request->input("title"),
                "body"=> $request->input("body")
    
            ]);

            return response([
                "message"=> "success", 
                "post"=> $post 
            ], 200);
        } catch (Exception $exception) {
            //throw $th;


            return response([
                "message"=> $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, $id)
    {
        //
        try {
            //code...
            $post = Post::findOrFail($id);
            $post->update($request->all());
            return response([
                "message"=> "success", 
                "post"=> $post
            ], 200); 

        } catch (\Exception $exception) {
            //throw $th;
            return response([
                "message"=> "update failed"
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        try {           
            $post = Post::findOrFail($id);
   
        } catch (ModelNotFoundException $exception) {
            //throw $th;
            
            return response([
                "message"=> "not found"
            ], 404);
        }

        $post->delete();

        return response([
            "message"=> "success", 
            
        ], 200); 
    }
}
