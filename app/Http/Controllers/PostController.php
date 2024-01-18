<?php

// Created (3:30): https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34351476#overview


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function showCreateForm(){
        // return 'Connection to PostController.php successful.';

        //(~1:30) - Add redirect if /create-post accessed by guest:
        if (!auth()->check()) {
            return redirect('/');
        } 
        return view('create-post');
    }

    public function storeNewPost(Request $request){
        // return 'hey!';
        //Added (~15:00): https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34351476#overview
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        //strip out any html tags
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);
        
        //Add on author id with user session auth() helper
        $incomingFields['user_id'] = auth()->id();

        
        //(5:40) - Store Post::create() in memory and then redirect to new post: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34351482#overview
            // //After set up Post Model use the create()
            // Post::create($incomingFields);
        $newPost = Post::create($incomingFields);

        // return 'Post successfully created in DB';
        //Use double quotes in the redirect() for string interpolation:
        return redirect("/post/{$newPost->id}")->with('success', 'New post successfully created!');
    }

    //Around (5:40): Show single post: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34351480#overview
    // (11:35) - type hinting (Post $pizza) - interpret value through Post model
        //Laravel can look up the object by id
        //Parameter {post} can be anything but must match name used in web.php
    // public function viewSinglePost(Post $pizza){
    public function viewSinglePost(Post $post){

        //Markdown Lesson: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34361474#overview
                // $ourHTML = Str::markdown($post->body);
                // $post['body'] = $ourHTML;
            // $post['body'] = Str::markdown($post->body);
        //(10:30) - Only allow certain tags: 
        $post['body'] = strip_tags(Str::markdown($post->body), '<p><ul><ol><li><strong><em><h3><h2><br>');


        // return $pizza->title; //returns post's title by id.
        return view('single-post', ['post' => $post]);
    }


// (11:40) - Delete Post via the Controller Way: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426438#overview
    public function delete(Post $post) {
        
        //Boolean Check to see if user can delete the post: 
        // auth()->user()->cannot('delete', $post)
 
//Use this check with traditional route: 
        // Route::delete('/post/{post}', [PostController::class, 'delete']);
            // if (auth()->user()->cannot('delete', $post)) {
            //     return 'You do not have permissions to delete this note';
            // }
//In (1:40) we used middleware in web.php instead to enforce Owner Only delete: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426442#overview
        $post->delete();

        return redirect('/profile/' . auth()->user()->username)->with('success', 'Post successfully deleted.');
    }

// (8:20) - Add VIEW and UPDATE post functions: https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/34426442#overview
    public function showEditForm(Post $post){
        return view('edit-post', ['post' => $post]);
    }

    public function actuallyUpdate(Post $post, Request $request){
        $incomingFields = $request->validate([
            'title' => 'required',
            'body' => 'required'
        ]);

        //strip out any html tags
        $incomingFields['title'] = strip_tags($incomingFields['title']);
        $incomingFields['body'] = strip_tags($incomingFields['body']);

        $post->update($incomingFields);

        return back()->with('success', 'Post successfully updated');
    }

}
