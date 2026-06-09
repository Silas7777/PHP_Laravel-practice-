<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //direct blog list page
    public function list(){
        return view('blog.list');//create view of the home page
    }

    public function create(Request $request){
        dd($request->all()); //view all data from form
    }
}
