@extends('layouts.sidebar')

@section('content')
<div class="container">
    @if (session('err'))
        <div class="alert alert-warning">
            {{ session('err') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif


    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-3">Creat New Admin Account</h3>
            <form method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <input type="file" name="image" class="form-control">
                </div>

                <button type="submit" class="btn text-light" style="background: #222;">Add Admin</button>

            </form>
        </div>

    </div>
</div>
@endsection
