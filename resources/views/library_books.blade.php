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
                <form class="row g-3" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    <div class="col-md-6">
                        <label for="validationBookName" class="form-label">Book Name</label>
                        <input type="text" id="validationBookName" class="form-control" name="bookname">
                    </div>
                    <div class="col-md-6">
                        <label for="validationBookAuthor" class="form-label">Book Author</label>
                        <input type="text" id="validationBookAuthor" class="form-control" name="bookauthor">
                    </div>
                    <div class="col-md-6">
                        <label for="validationBookType" class="form-label">Book Type</label>
                        <div class="input-group">
                            <select class="form-select" id="validationBookType" aria-label="Default select example">
                                <option value="Reference">Reference</option>
                                <option value="Lending">Lending</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Add Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


