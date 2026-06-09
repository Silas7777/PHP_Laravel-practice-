<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    //direct blog list page
    public function list(){
        return view('blog.list');//create view of the home page
    }

    //create blog
    public function create(Request $request){
        // dd($request->all()); //view all data from form
        $this->checkValidation($request); //call validate function

        return "Successful";
    }

    //form validation check
    private function checkValidation($request){

    $rule=[
        'title'=>'required|min:5|max:199',
        'description'=>'required|min:5',
        'image'=>'required|file|mimes:jpg,jpeg,png,webp,svg,gif',
        'ownerName'=>'min:5|max:49'
    ];

    $message=[
        'title.required'=> 'Title cannot be empty',
        'description.required'=> 'Description cannot be empty',
        'image.required'=> 'image cannot be empty',
        'ownerName.required'=> 'OwnerName cannot be empty',
        'title.require'=>'At least 5 characters required',
        'description.require'=>'At least 5 characters required',
        'image.require'=>'File type should be jpg,jpeg,png,webp,svg or gif',
        'ownerName.require'=>'At least 5 characters required',
    ];


    $request->validate($rule,$message);//check validation based on this rules and show this messages

    }

}
