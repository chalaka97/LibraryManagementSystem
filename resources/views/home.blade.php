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
                <h3 class="text">Borrow Books</h3>
                <form class="row g-3" method="post" enctype="multipart/form-data" action="{{'checkadd'}}">
                    @csrf

                    <div class="col-md-6">
                        <label for="validationAddress" class="form-label">User</label>
                        <div class="input-group">


                            <select class="form-select" aria-label="Default select example">
                                @foreach ($allusers as $dataAllUsers)
                                <option value="{{ $dataAllUsers->id }}">{{ $dataAllUsers->u_name }} - {{ $dataAllUsers->u_type }} </option>


                                @endforeach
                                    <input type="hidden" name="user_type" value="{{ $dataAllUsers->u_type }}">

                            </select>

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationAddress" class="form-label">Book</label>
                        <div class="input-group">
                            <select class="form-select" aria-label="Default select example">
                                @foreach ($allbooks as $dataAlllBooks)
                                <option value="{{ $dataAlllBooks->id }}">{{ $dataAlllBooks->b_title }} - {{ $dataAlllBooks->b_type }} </option>

                                @endforeach
                                    <input type="hidden" name="book_type" value="{{ $dataAlllBooks->b_type}}">
                            </select>
                        </div>
                    </div>

                    <div class="">
                        @if($msg=\Illuminate\Support\Facades\Session::get('success_bookborrowed'))
                            <div class="alert alert-success mt-3 mb-3">
                                {{ $msg }}
                            </div>
                        @endif
                        @if($msg=\Illuminate\Support\Facades\Session::get('error_bookborrowed'))
                            <div class="alert alert-danger mt-3 mb-3">
                                <h5 class="mt-5">Note: </h5> <label>{{ $msg }}</label>
                            </div>
                        @endif
                    </div>
                    <div class="col-12">
                        <button class="btn btn-success" type="submit">Submit Book</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  {{--  <script>
        validationDate.min = new Date().toISOString().split("T")[0]; // min date for time slot

    </script>--}}
@endsection

