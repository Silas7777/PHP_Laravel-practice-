<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //direct blog list page
    public function list(){
        return view('blog.list');
    }
}
