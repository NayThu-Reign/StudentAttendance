@extends('layouts.sidebar')


@section('content')
    <div class="container">
        @if (session('msg'))
            <div class="alert alert-info">
                {{ session('msg') }}
            </div>
        @endif

        <h3 class="mb-5">Student Profile</h3>
        <h4 class="mb-3">Student Name - {{$student->name}}</h4>
        <div class="mb-3" style="width: 230px; height: 150px; background: #222;" >
            @if($student->image)
                <img src="{{ asset('storage/' . $student->image) }}" alt="{{$student->name}}" style="width: 100%; height: 100%">
            @else
                <img src="{{ asset('OIP (32).jpg')}}" alt="{{$student->name}}" style="width: 100%; height: 100%">
            @endif
        </div>

        <ul class="list-group mb-3">
            <li class="list-group-item">

                <b>Email:</b> {{ $student->email}}
            </li>
            <li class="list-group-item">

                <b>PhoneNo:</b> {{ $student->phone_no}}
            </li>
            <li class="list-group-item">

                <b>FatherName:</b> {{ $student->father_name}}
            </li>
            <li class="list-group-item">

                <b>Address:</b> {{ $student->address}}
            </li>
            <li class="list-group-item">

                <b>Present Days in this Month: </b> {{ $presentDays }}
            </li>
        </ul>

        <a href="{{ url("/admin/students/edit/{$student->id}")}}" class="btn text-decoration-none text-light" style="background: #222">Edit</a>
    </div>
@endsection
