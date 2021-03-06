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
                <h3 class="text">Borrowed Book Details</h3>
                <div class="">
                    @if($msg=\Illuminate\Support\Facades\Session::get('update_success'))
                        <div class="alert alert-success mt-3 mb-3">
                            {{ $msg }}
                        </div>
                    @endif
                    @if($msg=\Illuminate\Support\Facades\Session::get('update_error'))
                        <div class="alert alert-danger mt-3 mb-3">
                            {{ $msg }}
                        </div>
                    @endif
                </div>
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
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($borrowedBooks as $dataBorrowedBooks)
                                <tr>
                                    <td>{{$dataBorrowedBooks->id}}</td>
                                    <td>{{$dataBorrowedBooks->u_name}}</td>
                                    <td>{{$dataBorrowedBooks->b_title}}</td>
                                    <td>{{$dataBorrowedBooks->b_type}}</td>
                                    <td>{{$dataBorrowedBooks->borrow_date}}</td>

                                    <td><a href="markasreceived/{{$dataBorrowedBooks->id}}">
                                            <p class="btn btn-primary">Mark as received</p>
                                        </a></td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

