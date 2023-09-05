<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;

class ProfilePhotoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function profilePanel()
    {
        $userdata = User::find(auth()->user()->id);
        $sortedPosts = $userdata->articles()->orderBy('created_at', 'desc')->paginate(5);
        return view('users.profile',
        [
            'user' => $userdata,
            'userPosts' => $sortedPosts,
        ]);
    }

    public function upload(Request $request)
    {
        $request->validate(['profile_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048']);

        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user = User::find(auth()->user()->id);
            $user->profile_photo = $path;
            $user->save();
        }

        return redirect('/profile')->with('success', 'Profile Photo Uploaded');
    }


}
