<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    //get post data
    public function getPost(){
        $data = Post::orderBy('id','desc')->get();
        // dd($data);
        return response()->json([
            'posts' => $data
        ]);
    }

    public function postBook(Request $request){
        // logger($request->all());
        // return response()->json([
        //     'res' => $request->all()
        // ]);
        Post::create([
            'id' => $request->bookId,
            'title' => $request->bookTitle,
            'author' => $request->bookAuthor,
            'description' => $request->bookDescription
        ]);
    }

    public function getSingleBook(Request $request){
        // logger($request->all());
    }

    public function updateBook(Request $request){
        // logger($request->all());
        $updateData = [
            'title' => $request->bookTitle,
            'author' => $request->bookAuthor,
            'description' => $request->bookDescription
        ];
        Post::where('id',$request->updateId)->update($updateData);
    }

    public function deleteBook(Request $request){
        logger($request->all());
        Post::where('id',$request->deleteId)->delete();
    }

    public function uploadBookImage(Request $request){
        logger($request->all());
        if($request->hasFile('data')){
            $file = $request->file('data');
            $file_name = time().'.'.getClientOriginalName();
            $file->move(public_path('image'), $file_name);
        }
    }
}
