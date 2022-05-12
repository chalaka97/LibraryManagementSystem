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
                <h3 class="text">Add User</h3>
                <form class="row g-3" method="post" enctype="multipart/form-data" action="">
                    @csrf
                    <div class="col-md-6">
                        <label for="validationUserName" class="form-label">User Name</label>
                        <input type="text" id="validationUserName" class="form-control" name="username">
                    </div>
                    <div class="col-md-6">
                        <label for="validationUserEmail" class="form-label">User Email</label>
                        <input type="text" id="validationUserEmail" class="form-control" name="useremail">
                    </div>
                    <div class="col-md-6">
                        <label for="validationUserContact" class="form-label">User Contact</label>
                        <input type="tel" pattern="[0-9]{10}" id="validationUserEmail" class="form-control" name="usercontact">
                    </div>
                    <div class="col-md-6">
                        <label for="validationUserType" class="form-label">User Type</label>
                        <div class="input-group">
                            <select class="form-select" id="validationUserType" aria-label="Default select example">
                                <option value="Student">Student</option>
                                <option value="Faculty member">Faculty members</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

