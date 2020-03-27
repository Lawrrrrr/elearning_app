<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index', compact('users'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = User::findOrFail($user_id);

        if(auth()->user()->id == $user->id)
            return redirect()->route('home');
        else
            return view('users.profile', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|string|email'
        ]);

        if(!empty($request->new_password))
        {
            $request->validate([
                "new_password" => "required|min:8|max:255|confirmed"
            ]);

            auth()->user()->update([
                'password' => Hash::make($request->new_password)
            ]);
        }

        auth()->user()->update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email
        ]);

        return redirect()->route('home');
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
    }

    public function uploadAvatar(Request $request)
    {
        $oldAvatar = auth()->user()->avatar;
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,jpg,png,gif|max:2048'
        ]);

        if($oldAvatar != 'nofaces.png')
        {
            File::delete(public_path('images') . '/' . $oldAvatar);
        }

        $fileName = time() . '.' . $request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('images'), $fileName);

        auth()->user()->update([
            'avatar' => $fileName
        ]);
        
        return redirect()->back();
    }

    public function follow($followed_id)
    {
        $follower = auth()->user();
        $follower->followedUsers()->attach($followed_id);

        return redirect()->back();
    }

    public function unfollow($followed_id)
    {
        $follower = auth()->user();
        $follower->followedUsers()->detach($followed_id);

        return redirect()->back();
    }
}
