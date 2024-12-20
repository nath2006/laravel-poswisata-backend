<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    //edit
    public function edit(User $user) {
        return view('pages.users.edit', compact('user'));
    }

    //update
    public function update(Request $request, User $user){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|min:6',
            'phone'=>'required',
            'role'=>'required',
        ]);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->save();

        //check if phone is not empty
        if ($request->phone) {
            $user->update(['phone' => $request->phone]);
        }
        //check if password is not empty
        if ($request->password) {
            $user->update(['password' => Hash::make($request->password)]);
        }
        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    //destroy
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }

    //count admin
    public function getAdminCount()
    {
        $adminCount = User::where('role', 'admin')->count();
        return $adminCount;
    }
}
