@extends('layouts.sidebar')

@section('content')
   <div class="ms-4">
       @foreach ($grades as $grade)
           <h3>{{$grade->name}} Grade's Classrooms</h3>
           <div class="mt-5 d-flex flex-wrap gap-4" style="margin-left: 10px">
                @foreach ($grade->classrooms as $classroom)
                    <a href="{{ url("/admin/classrooms/detail/$classroom->id")}}" class="d-flex justify-content-center align-items-center text-decoration-none h3"  style="width: 250px; height: 150px; border: 1px solid black;">

                        {{$classroom->name}}
                    </a>
                @endforeach
            </div>
       @endforeach
   </div>

   <div class="d-flex justify-content-end" style="margin-right: 70px; margin-top: 40px">
        {{$grades->links()}}
   </div>
@endsection
