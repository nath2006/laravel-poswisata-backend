<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserControler extends Controller
{
    //index
    public function index(Request $request)
    {
        $users = DB::table('users')->when($request->keyword, function ($query) use ($request) {
            $query->where('name','like',"%{$request->keyword}%")
                ->orWhere('email','like',"%{$request->keyword}%")
                ->orWhere('phone','like',"%{$request->keyword}%") ;
        })->orderBy('id','desc')->paginate(10);
        return view('pages.users.index',compact('users'));
    }

    //create
    public function create()
    {
        return view(('pages.users.create'));
    }

    //store
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6',
            'phone'=>'required',
            'role'=>'required',
        ]);

        User::create($request->all());
        return redirect()->route('users.index')->with('success','User created succesfully');
    }
}
