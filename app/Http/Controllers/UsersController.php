<?php

namespace App\Http\Controllers;

use App\Models\Userall;
use App\Models\Post;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        $valeus = Userall::all();
        $users = [];
        foreach ($valeus as $user) {
            $users[] = $user->getAttributes();
        }
        return view("users.index", ["users" => $users]);
    }
    public function create()
    {
        return view("users.create");
    }
    public function store()
    {
        $validated = request()->validate([
            'username' => 'required|min:3',
            'email' => 'required|email|unique:useralls,email',
            'password' => 'required|min:5',
            'phone' => ['regex:/^01[0-9]{9}$/', 'required']
        ]);
        if ($validated) {
            $name = request()->username;
            $email = request()->email;
            $password = request()->password;
            $encryptedPassword = Hash::make($password);
            $phone = request()->phone;
            Userall::create([
                "name" => $name,
                "email" => $email,
                "password" => $encryptedPassword,
                "phone" => $phone
            ]);
            return redirect()->route("users.index")->with('msg', 'The user has been added successfully!');
        }
    }
    public function show($userid)
    {
        $user = Userall::where("id", $userid)->first();
        if ($user) {
            return view("users.show", ["user" => $user]);
        }else {
            return redirect()->route("users.index")->with('msg','No User found with this id');
        }
    }
    public  function edit($userid)
    {
        $user = Userall::where("id", $userid)->first();
        if($user){
            return view("users.edit", ["user"=>$user]);
        }else {
            return redirect()->route("users.index")->with('msg','No User found with this id');
        }
    }
    public function update($userid)
    {
        $validated = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:useralls,email',
            'password' => 'required|min:5',
            'phone' => ['regex:/^01[0-9]{9}$/', 'required']
        ]);
        if ($validated) {
            $name = request()->name;
            $email = request()->email;
            $password = request()->password;
            $encryptedPassword = Hash::make($password);
            $phone = request()->phone;
            $result = Userall::where("id",$userid)->update(["name"=>$name,"email"=>$email,"password"=>$encryptedPassword,"phone"=>$phone]);
            if($result){
                return redirect()->route("users.show",$userid)->with('msg', 'The user has Edit successfully!');
            }
            else{
                return redirect()->route("users.edit",$userid)->with('msg', 'The user has been Faild Edit!');
            }
        }
    }

    public function destroy($userid)
{
    Post::where('user_id', $userid)->delete();
    $user = Userall::find($userid);
    $deleted = $user->delete();
    if ($deleted) {
        return redirect()->route("users.index")->with('msg','User Deleted Successfully');
    } else {
        return redirect()->route("users.index")->with('msg','Error in Deleting the User');
    }
}

public function clear()
{
    Post::query()->delete();
    Userall::query()->delete();
    return redirect()->route("users.index")->with("msg","Table Cleared");
}

}
