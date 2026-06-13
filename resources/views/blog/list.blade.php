@extends('layouts.master')

@section('title', 'Mini Blog Project')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-5">

                @if (Session::has('success'))
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
                                <input type="text" name="title" value="{{ old('title') }}"
                                    class="form-control w-100 @error('title') is-invalid @enderror"
                                    placeholder="Enter Blog Title...">
                                @error('title')
                                    <div class="invalid-message text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <textarea name="description" id="" cols="30" rows="10" placeholder="Enter Message..."
                                    class="form-control w-100 @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-message text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <input type="file" name="image" value="{{ old('image') }}"
                                    class="form-control w-100 @error('image') is-invalid @enderror" placeholder="">
                                @error('image')
                                    <div class="invalid-message text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <input type="text" name="ownerName" value="{{ old('ownerName') }}"
                                    class="form-control w-100 @error('ownerName') is-invalid @enderror"
                                    placeholder="Enter Owner Name...">
                                @error('ownerName')
                                    <div class="invalid-message text-danger">{{ $message }}</div>
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

                <form action="{{ route('blog#list')}}" method="">
                    @csrf
                    <div class="col-4 offset-8">
                    <div class="input-group">
                        <input type="text" name="searchKey" value="{{ request('searchKey')}}" class="form-control" placeholder="Enter Search Title..." aria-label="Input group example" aria-describedby="btnGroupAddon2">
                        <button type="submit" class="btn btn-outline-secondary input-group-text"><i class="fa-solid fa-magnifying-glass"></i></button>

                    </div>
                </div>
                </form>

                @if(count($blogs) != 0)

                @foreach ($blogs as $item)
                    {{-- showing data from database --}}
                    <div class="card my-2 shadow-sm ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-2">
                                    <img class="img-thumbnail" src="{{ asset('blogImages/' . $item->image) }}"
                                        alt="">
                                </div>
                                <div class="col-8">
                                    <div class="">{{ $item->title }}</div>
                                    <p class="text-muted">{{ $item->description }}</p>
                                    <p>Written by - {{ $item->owner_name }}</p>
                                    <p>{{ $item->created_at->format("j-F-Y")}}</p>
                                </div>
                                <div class="col">
                                    <a href="{{ route('blog#edit',$item->id)}}"><button class="btn btn-outline-primary btn-sm"><i
                                            class="fa-solid fa-pen-to-square"></i></button></a>

                                 <button type="button" class="btn btn-outline-danger btn-sm" onclick="confrimDelete({{ $item->id}})"><i class="fa-solid fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                    @else
                    <h3 class="text-muted text-center">There is no data....</h3>
                @endif

                <span>{{ $blogs->links() }}</span>



            </div>
        </div>
    </div>
@endsection

@section('js-script')

    <script>
        function confrimDelete($id) {
            console.log($id);

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) Swal.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });

                setInterval(() => {
                    location.href = "/blog/delete/" + $id;
                }, 1000);


            });
        }
    </script>

@endsection
