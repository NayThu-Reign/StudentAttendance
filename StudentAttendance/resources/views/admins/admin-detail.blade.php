@extends('layouts.sidebar')


@section('content')
    <div class="container">
        @if (session('msg'))
            <div class="alert alert-info">
                {{ session('msg') }}
            </div>
        @endif

        <h3 class="mb-5">Admin Profile</h3>
        <h4 class="mb-3">Admin Name - {{$admin->name}}</h4>
        <div class="mb-3" style="width: 230px; height: 150px; background: #222;" >
            @if($admin->image)
                <img src="{{ asset('storage/' . $admin->image) }}" alt="{{$admin->name}}" style="width: 100%; height: 100%">
            @else
                <img src="{{ asset('vector-users-icon.jpg')}}" alt="{{$admin->name}}" style="width: 100%; height: 100%">
            @endif
        </div>

        <ul class="list-group mb-3">
            <li class="list-group-item">
                <b>Email:</b> {{ $admin->email}}
            </li>

        </ul>

        <a href="{{ url("/admin/admins/edit/{$admin->id}")}}" class="btn text-decoration-none text-light" style="background: #222">Edit</a>
    </div>
@endsection
