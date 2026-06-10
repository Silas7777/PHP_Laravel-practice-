@extends('layouts.master')

@section('title','Mini Blog Project')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-5">

                @if(Session::has('success'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ Session::get('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>

                @endif

                <form action=" {{ route('blog#create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="my-2">
                                <input type="text" name="title" value="{{ old('title')}}" class="form-control w-100 @error ('title') is-invalid @enderror" placeholder="Enter Blog Title..." >
                                @error('title')
                                    <div class="invalid-message text-danger">{{$message}}</div>
                                @enderror
                            </div>
                             <div class="my-2">
                                <textarea name="description" id="" cols="30" rows="10" placeholder="Enter Message..." class="form-control w-100 @error ('description') is-invalid @enderror" >{{ old('description')}}</textarea>
                                @error('description')
                                    <div class="invalid-message text-danger">{{$message}}</div>
                                @enderror
                            </div>
                             <div class="my-2">
                                <input type="file" name="image" value="{{ old('image')}}" class="form-control w-100 @error ('image') is-invalid @enderror" placeholder="" >
                                @error('image')
                                    <div class="invalid-message text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <input type="text" name="ownerName" value="{{ old('ownerName')}}" class="form-control w-100 @error ('ownerName') is-invalid @enderror" placeholder="Enter Owner Name...">
                                @error('ownerName')
                                    <div class="invalid-message text-danger">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <input type="submit" value="Create" class="btn bg-dark text-whtie shadow-sm rounded">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">

                @foreach ($blogs as $item)
                {{-- showing data from database --}}
                <div class="card my-2 shadow-sm ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <img class="img-thumbnail" src="{{asset('blogImages/'.$item->image )}}" alt="">
                            </div>
                            <div class="col-8">
                                <div class="">{{ $item->title}}</div>
                                <p class="text-muted">{{$item->description}}</p>
                                <p>Written by - {{ $item->owner_name}}</p>
                            </div>
                            <div class="col">
                                <button class="btn btn-outline-primary btn-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach

                <span>{{$blogs->links()}}</span>



            </div>
        </div>
    </div>
@endsection
