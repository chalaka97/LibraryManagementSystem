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
                <h3 class="text">Fined Details</h3>
                <form class="row g-3" method="post" enctype="multipart/form-data" action="">
                    @csrf

                    <div class="col-md-12">
                        <div class="quotations-tb">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">User</th>
                                    <th scope="col">Book</th>
                                    <th scope="col">Book Type</th>
                                    <th scope="col">Total Days</th>
                                    <th scope="col">Total Payment</th>
                                    <th scope="col">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>321</td>
                                    <td>Supun - Student</td>
                                    <td>Gam peraliya</td>
                                    <td>Reference</td>
                                    <td>5</td>
                                    <td>220</td>
                                    <td> <button class="btn btn-primary" type="submit">Mark as received & Remove Suspend</button></td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
            <div>
                <h2 class="text h2">for check</h2>
                <div class="btn btn-info">
                    <a href="{{route('fineddetails')}}">
                        <p class="text-white ">Fined DEtails</p>
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

