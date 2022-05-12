@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="text m-3">Admin Dashboard</h2>
            <div class="m-3">
                <li class="btn btn-primary {{ (request()->route()->getName()=='home')?'active':'' }}">
                    <a href="{{route('home')}}">
                        <p class="text-white ">Borrow Books</p>
                    </a>
                </li>
                <li class="btn btn-primary {{ (request()->route()->getName()=='borrowed')?'active':'' }}">
                    <a href="{{route('borrowed')}}">
                        <p class="text-white ">Borrowed Book List</p>
                    </a>
                </li>
                <li class="btn btn-primary {{ (request()->route()->getName()=='users')?'active':'' }}">
                    <a href="{{route('users')}}">
                        <p class="text-white ">Add User</p>
                    </a>
                </li>
                <li class="btn btn-primary {{ (request()->route()->getName()=='books')?'active':'' }}">
                    <a href="{{route('books')}}">
                        <p class="text-white ">Add Book</p>
                    </a>
                </li>
                <li class="btn btn-primary {{ (request()->route()->getName()=='fined-details')?'active':'' }}">
                    <a href="{{route('fined-details')}}">
                        <p class="text-white ">Fined Details</p>
                    </a>
                </li>
            </div>
            <div class="col-10 mt-3">
                <h3 class="text">Add Book</h3>
                <div class="">
                    @if($msg=\Illuminate\Support\Facades\Session::get('success_book'))
                        <div class="alert alert-success mt-3 mb-3">
                            {{ $msg }}
                        </div>
                    @endif
                    @if($msg=\Illuminate\Support\Facades\Session::get('error_book'))
                        <div class="alert alert-danger mt-3 mb-3">
                            {{ $msg }}
                        </div>
                    @endif
                </div>
                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('addbook') }}">
                    @csrf
                    <div class="col-md-6">
                        <label for="validationBookName" class="form-label">Book Name</label>
                        <input type="text" id="validationBookName" class="form-control" name="bookname">
                        <span class="text text-danger">@error('bookname'){{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <label for="validationBookAuthor" class="form-label">Book Author</label>
                        <input type="text" id="validationBookAuthor" class="form-control" name="bookauthor">
                        <span class="text text-danger">@error('bookauthor'){{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <label for="validationBookType" class="form-label">Book Type</label>
                        <div class="input-group">
                            <select class="form-select" name="booktype" id="validationBookType" aria-label="Default select example">
                                <option value="Reference">Reference</option>
                                <option value="Lending">Lending</option>
                            </select>
                        </div>
                        <span class="text text-danger">@error('booktype'){{ $message }} @enderror</span>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


