<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use RealRashid\SweetAlert\Facades\Alert;

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
        $this->checkValidation($request,'create'); //call validate function

        // return "Successful";

        $data = $this->getBlogData($request); //title, description, ownername

        if($request->hasFile('image')){
            $fileName = uniqid() . $request->file('image')->getClientOriginalName(); //getting image file original name
            $request->file('image')->move( public_path() . '/blogImages/' , $fileName);//creating file path and store files

            $data['image'] = $fileName;
        }

        Blog::create($data);

        alert()->success('Successful!', 'Blog created successfully...'); //show message



        return back(); //back to page
    }

    //delete blog
    public function delete($id){

        $oldImage = Blog::where('id', $id)->value('image'); //find image id with delete id

        //check if image exist or not
        if(file_exists(public_path('blogImages/'. $oldImage))){
            unlink(public_path('blogImages/'. $oldImage)); //if exist oldimage, unlink the oldimage and delete
        }

        Blog::where('id',$id)->delete(); //delete the whole blog


        // alert()->success('Successful!', 'Blog deleted successfully...'); //show message


        return back();//back to page

    }


    //edit blog
    public function edit($id){
        $blog = Blog::where('id', $id)->first();

        return view('blog.edit',compact('blog'));

    }

    //update blog
    public function update(Request $request, $id){

        $request['id'] = $id;
        $this->checkValidation($request,'update');

        $data = $this->getBlogData($request);

         if($request->hasFile('image')){

         $oldImage = $request->oldImage; //old image name

          if(file_exists(public_path('blogImages/'. $oldImage))){
            unlink(public_path('blogImages/'. $oldImage)); //if exist oldimage, unlink the oldimage and delete
        }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName(); //getting image file original name
            $request->file('image')->move( public_path() . '/blogImages/' , $fileName);//creating file path and store files

            $data['image'] = $fileName;
        }

        Blog::where('id',$id)->update($data); //update in database

        alert()->success('Successful!', 'Blog updated successfully...'); //show message

        return to_route('blog#list'); //back to list page

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
    private function checkValidation($request,$action){

    $rule=[
        'title'=>'required|min:5|max:199|unique:blogs,title,'.$request->id, //title must be unique expect itself for update
        'description'=>'required|min:5',
        'ownerName'=>'min:5|max:49'
    ];


    $rule['image']= $action == 'create' ? 'required|file|mimes:jpg,jpeg,png,webp,svg,gif' : 'file|mimes:jpg,jpeg,png,webp,svg,gif';

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
