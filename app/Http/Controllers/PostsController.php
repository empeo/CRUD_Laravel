<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Userall;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostsController extends Controller
{
    public function index()
    {
        $users = Userall::all();
        $posts = Post::all();
        return view("posts.index", ["posts" => $posts , "users"=>$users]);
    }
    public function create()
    {
        $users = Userall::all();
        if($users->count()>0){
            return view("posts.create",["users"=>$users]);
        }
        else{
            return redirect()->route("users.index")->with("msg","Please Create a user first");
        }
    }
    public function store()
    {
        $validated = request()->validate([
            'title' => 'required|min:3|unique:posts,title',
            'description' => 'required|min:10',
            'user_id' => 'required',
        ]);
        if ($validated) {
            $title = request()->title;
            $description = request()->description;
            $user_id = request()->user_id;
            Post::create([
                "title" => $title,
                "description" => $description,
                "user_id" => $user_id,
            ]);
            return redirect()->route("posts.index")->with('msg', 'The Post has been added successfully!');
        }
    }
    public function show($postid)
    {
        $post = Post::where("id", $postid)->first();
        if ($post) {
            return view("posts.show", ["post" => $post]);
        }else {
            return redirect()->route("posts.index")->with('msg','No Post found with this id');
        }
    }
    public  function edit($postid)
    {
        $users = Userall::all();
        $post = Post::where("id", $postid)->first();
        if($post){
            return view("posts.edit", ["post"=>$post,"users"=>$users]) ;
        }else {
            return redirect()->route("posts.index")->with('msg','No Post found with this id');
        }
    }
    public function update($postid)
    {
        $validated = request()->validate([
            'title' => 'required|min:3|unique:posts,title',
            'description' => 'required|min:10',
            'user_id' => 'required',
        ]);
        if ($validated) {
            $title = request()->title;
            $description = request()->description;
            $user_id = request()->user_id;
            $result = Post::where("id",$postid)->update(["title"=>$title,"description"=>$description,"user_id"=>$user_id]);
            if($result){
                return redirect()->route("posts.show",$postid)->with('msg', 'The Post has Edit successfully!');
            }
            else{
                return redirect()->route("posts.edit",$postid)->with('msg', 'The Post has been Faild Edit!');
            }
        }
    }
    public function destroy($postid)
    {
        $post = Post::where("id",$postid)->delete();
        if($post){
            return redirect()->route("posts.index")->with('msg','Post Delete Successfully');
        }else{
            return redirect()->route("posts.index")->with('msg','Error in Deleting the Post');
        }
    }
    public function clear()
    {
        Post::query()->delete();
        return redirect()->route("posts.index")->with(["msg" => "Table Cleared"]);
    }
}
