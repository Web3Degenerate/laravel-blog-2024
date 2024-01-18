<?php

// Created at (8:50): https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34476616#overview

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    

    public function createFollow(User $user) {

        //(1) You cannot follow yourself
            // if the user_id trying follow == logged in user's id (follow self)
                if ($user->id == auth()->user()->id) {
                    return back()->with('failure', 'You can not follow yourself.');
                }

        // (2) You cannot follow someone you've already followed
            // check if logged in user already following user_id attempting to follow in Followers Table
                //use Follow class static method of 'where()'
                // $existCheck = Follow::where()->count();
                    //two sub arrays in our where() method
                    // $existCheck = Follow::where([ [], [] ])->count();
                        // 1 - see if already a row where user_id and followeduser values exist
                            // 1 - (A) user_id, (B) =, (C) loggedin user
                            // AND
                            // 2 - (A) followeduser, (B) =, (C) user_id attempting to follow
                    $existCheck = Follow::where([ ['user_id', '=', auth()->user()->id], 
                                                  ['followeduser', '=', $user->id] ])->count();
                //BY CALLING '->count()' it returns 1 if true. Won't be zero. So we can use it in if statement below: 
                if ($existCheck) {
                    return back()->with('failure', 'You are already following that user.');
                }

    //OG way instead of 'Follow::create(); when model mass assignable.
        $newFollow = new Follow; 
        $newFollow->user_id = auth()->user()->id; //whatever user logged in, that is who is creating the follow.
        $newFollow->followeduser = $user->id; //coming from the URL via user's username
        $newFollow->save(); 

        // (18:10) - https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34476616#overview
            // My own shit: 
            $displayUsername = ucwords($user->username);
        return back()->with('success', 'You are now following ' . $displayUsername . ' !');    
    }


// (7:55) - Set up removeFollow: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34476624#overview
    public function removeFollow(User $user) {
        // Query for the entry in the Follows table
            // A - Follows Table user_id equals logged in user of current session.
            // B - Follwed user equals the user who is being requested. 
        // Tack on the '->delete()' method
        Follow::where([ ['user_id', '=', auth()->user()->id], ['followeduser', '=', $user->id] ])->delete();

            // My custom flash message variable: 
            $displayUsername = ucwords($user->username);
        return back()->with('success', 'You are no longer following ' . $displayUsername . ' .');
    }

}
