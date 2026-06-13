@extends('layouts.master')

@section('title', 'Mini Blog Project')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-6 offset-3">
                <a href="{{ route('blog#list')}}" class="btn bg-dark text-white m-1 p-2 rounded shadow-sm">Back</a>
                <form action=" {{ route('blog#update', $blog->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- get oldimage for update --}}
                    <input type="hidden" name="oldImage" value="{{ $blog->image}}">

                    <div class="card">
                        <div class="card-body">
                            <div class="my-2 text-center">
                                <img src="{{ asset('blogImages/'. $blog->image)}}" class="w-50" alt="">
                            </div>
                            <div class="my-2">
                                <input type="text" name="title" value="{{ old('title',$blog->title )}}"
                                    class="form-control w-100 @error('title') is-invalid @enderror"
                                    placeholder="Enter Blog Title...">
                                @error('title')
                                    <div class="invalid-message text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <textarea name="description" id="" cols="30" rows="10" placeholder="Enter Message..."
                                    class="form-control w-100 @error('description') is-invalid @enderror">{{ old('description',$blog->description )}}</textarea>
                                @error('description')
                                    <div class="invalid-message text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <input type="file" name="image" value="{{ old('image', $blog->image) }}"
                                    class="form-control w-100 @error('image') is-invalid @enderror" placeholder="">
                                @error('image')
                                    <div class="invalid-message text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <input type="text" name="ownerName" value="{{ old('ownerName',$blog->owner_name) }}"
                                    class="form-control w-100 @error('ownerName') is-invalid @enderror"
                                    placeholder="Enter Owner Name...">
                                @error('ownerName')
                                    <div class="invalid-message text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <input type="submit" value="Update" class="btn bg-dark text-whtie shadow-sm rounded">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

