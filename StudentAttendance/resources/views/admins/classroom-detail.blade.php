@extends('layouts.sidebar')

@section('content')
   <div class="ms-4">

      <h3 class="mb-5">Classroom {{$classroom->name}}</h3>

      <div class="d-flex justify-content-between align-items-center mb-4">
            <a href="{{ url('/admin/students/create')}}" class="btn text-decoration-none text-light mb-3"  style="background: #222">Add New Student </a>
            <div class="d-flex gap-5">
                <div>

                    <div class="dropdown">
                        <button class="btn dropdown-toggle text-light" style="background: #222" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            SortBy
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item sort" href="{{ url()->current() }}">All Students</a></li>
                            <li><a class="dropdown-item sort" href="{{ url()->current() }}?gender=male">Male</a></li>
                            <li><a class="dropdown-item sort" href="{{ url()->current()}}?gender=female">Female</a></li>
                        </ul>
                    </div>

                </div>


                <form method="GET" class="me-5">
                    <div class="input-group">
                        <input type="text" class="form-control" name="student" placeholder="Search...">
                        <button type="submit" class="btn text-light" style="background: #222">Search</button>
                    </div>
                </form>
            </div>
      </div>

      <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Grade</th>
            <th>Father Name</th>
            <th>Phone_No</th>
            <th>Email</th>
            <th>Address</th>
        </tr>
        @foreach ($students as $student)
            @if($student->grade_id === $classroom->grade_id and $student->classroom_id === $classroom->id)

                <tr>
                    <td>{{$student->id}}</td>
                    <td><a href="{{url("admin/students/detail/$student->id")}}" class="text-dark">{{$student->name}}</a></td>
                    <td>{{$student->gender->name}}</td>
                    <td>{{$student->grade->name}}</td>
                    <td>{{$student->father_name}}</td>
                    <td>{{$student->phone_no}}</td>
                    <td>{{$student->email}}</td>
                    <td>{{$student->address}}</td>
                </tr>

            @endif

        @endforeach
      </table>

   </div>


   <div class="d-flex justify-content-end" style="margin-right: 70px; margin-top: 40px">
        {{$students->links()}}
    </div>


@endsection
