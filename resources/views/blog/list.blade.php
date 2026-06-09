@extends('layouts.master')

@section('title','Mini Blog Project')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-4">
                <form action=" {{ route('blog#create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="my-2">
                                <input type="text" name="title" class="form-control w-100" placeholder="Enter Blog Title...">
                            </div>
                             <div class="my-2">
                                <textarea name="" id="" cols="30" rows="10" placeholder="Enter Message..." class="form-control w-100"></textarea>
                            </div>
                             <div class="my-2">
                                <input type="file" name="image" class="form-control w-100" placeholder="">
                            </div>
                            <div class="my-2">
                                <input type="text" name="ownerName" class="form-control w-100" placeholder="Enter Owner Name...">
                            </div>
                            <div class="my-2">
                                <input type="submit" value="Create" class="btn bg-dark text-whtie shadow-sm rounded">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">

                <div class="card my-2 shadow-sm ">
                    <div class="card-body">
                        <div class="d-flex justify-content-around">
                            <div class="">
                                Hello World
                            </div>
                            <div class="">
                                <button class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card my-2 shadow-sm ">
                    <div class="card-body">
                        <div class="d-flex justify-content-around">
                            <div class="">
                                Hello World
                            </div>
                            <div class="">
                                <button class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card my-2 shadow-sm ">
                    <div class="card-body">
                        <div class="d-flex justify-content-around">
                            <div class="">
                                Hello World
                            </div>
                            <div class="">
                                <button class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
