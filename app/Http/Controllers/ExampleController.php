<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExampleController extends Controller
{
    
    public function homePage() {
        //Pass single variable to view
        $ourName = 'Guest';

        //pass array to view as well: (14:38) https://www.udemy.com/course/lets-learn-laravel-a-guided-path-for-beginners/learn/lecture/33973256#content
        $animals = ['Meowsalot', 'Barksalot', 'Purrsloud'];

        // return view('homepage', ['name' => $ourName, 'catname' => 'Meowsalot']);
        return view('homepage', ['allAnimals' => $animals, 'name' => $ourName, 'catname' => 'Meowsalot']);
        
    }

    public function aboutPage(){
        // return '<h2>About Us</h2>';
        return view('single-post');
    }
}
