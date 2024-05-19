@extends('layouts.sidebar')

@section('content')
<div class="container">

    @if (session('adm'))
        <div class="alert alert-info">
            {{ session('adm') }}
        </div>
    @endif



    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{$admin->name}}">
                </div>
                <div class="mb-2">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{$admin->email}}">
                </div>

                <div class="mb-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="{{$admin->password}}">
                </div>
                <div class="mb-2">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="input-group mb-3">
                    <input type="file" name="image" class="form-control" value="{{$admin->image}}">
                </div>

                <button type="submit" class="btn text-light" style="background: #222;">Update</button>

            </form>
        </div>
    </div>
</div>
@endsection
