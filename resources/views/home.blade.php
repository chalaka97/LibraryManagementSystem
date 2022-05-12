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
                <h3 class="text">Borrow Books</h3>
                <form class="row g-3" method="post" enctype="multipart/form-data" action="">
                    @csrf

                    <div class="col-md-6">
                        <label for="validationAddress" class="form-label">User</label>
                        <div class="input-group">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select User</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="validationAddress" class="form-label">Book</label>
                        <div class="input-group">
                            <select class="form-select" aria-label="Default select example">
                                <option selected>Select User</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                   {{-- <div class="col-md-3">
                        <label for="validationDate" class="form-label">Date</label>
                        <input type="date" name="pre_date" min="2022-05-06" class="form-control" id="validationDate"
                               required>
                        --}}{{--<span class="text text-danger">@error('pre_date'){{ $message }} @enderror</span>--}}{{--
                    </div>--}}


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

