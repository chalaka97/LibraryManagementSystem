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
                <h3 class="text">Add User</h3>
                <div class="">
                    @if($msg=\Illuminate\Support\Facades\Session::get('success_user'))
                        <div class="alert alert-success mt-3 mb-3">
                            {{ $msg }}
                        </div>
                    @endif
                    @if($msg=\Illuminate\Support\Facades\Session::get('error_user'))
                        <div class="alert alert-danger mt-3 mb-3">
                            {{ $msg }}
                        </div>
                    @endif
                </div>
                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{ route('addlibraryuser') }}">
                    @csrf
                    <div class="col-md-6">
                        <label for="validationUserName" class="form-label">User Name</label>
                        <input type="text" id="validationUserName" class="form-control" name="username">
                        <span class="text text-danger">@error('username'){{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <label for="validationUserEmail" class="form-label">User Email</label>
                        <input type="text" id="validationUserEmail" class="form-control" name="useremail">
                        <span class="text text-danger">@error('useremail'){{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <label for="validationUserContact" class="form-label">User Contact</label>
                        <input type="tel" pattern="[0-9]{10}" id="validationUserEmail" class="form-control" name="usercontact">
                        <span class="text text-danger">@error('usercontact'){{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <label for="validationUserType" class="form-label">User Type</label>
                        <div class="input-group">
                            <select name="usertype" class="form-select" id="validationUserType" aria-label="Default select example">
                                <option value="Student">Student</option>
                                <option value="Faculty member">Faculty members</option>
                            </select>
                        </div>
                        <span class="text text-danger">@error('usertype'){{ $message }} @enderror</span>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

