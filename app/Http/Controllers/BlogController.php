<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //direct blog list page
    public function list(){

        $blogs = Blog::select('id', 'title', 'description', 'image', 'owner_name', 'created_at') //getting data from database
                    ->orderby('created_at', 'desc')
                    ->paginate(4);

        return view('blog.list', compact('blogs'));//create view of the home page
    }

    //create blog
    public function create(Request $request){
        // dd($request->all()); //view all data from form
        $this->checkValidation($request); //call validate function

        // return "Successful";

        $data = $this->getBlogData($request); //title, description, ownername

        if($request->hasFile('image')){
            $fileName = uniqid() . $request->file('image')->getClientOriginalName(); //getting image file original name
            $request->file('image')->move( public_path() . '/blogImages/' , $fileName);

            $data['image'] = $fileName;
        }

        Blog::create($data);

        return back()->with(['success' => 'Blog created successfully...']);
    }

    //request blog data
    private function getBlogData($request){
        return [
            'title' => $request->title ,
            'description' => $request->description,
            'owner_name' => $request->ownerName ,
        ];
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
