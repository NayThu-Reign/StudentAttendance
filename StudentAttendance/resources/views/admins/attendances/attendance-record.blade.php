@extends('layouts.sidebar')

@section('content')
   <div class="ms-4">

      <h3 class="mb-3">Classroom {{$classroom->name}}</h3>

      <h3 class="mb-4">Present Students - {{$presentStudents}}</h3>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ url('/admin/students/create')}}" class="btn text-decoration-none text-light mb-3"  style="background: #222">Add New Student </a>
        <div class="d-flex gap-5">
            <div>

                <div class="dropdown">
                    <button class="btn dropdown-toggle  text-light" style="background: #222" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        SortBy
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item sort" href="{{ url()->current() }}?date={{ request('date') }}">All Students</a></li>
                        <li><a class="dropdown-item sort" href="{{ url()->current() }}?gender_id=1&date={{ request('date') }}">Male</a></li>
                        <li><a class="dropdown-item sort" href="{{ url()->current()}}?gender_id=2&date={{ request('date') }}">Female</a></li>
                    </ul>
                </div>

            </div>

            <form method="GET" class="me-5">
                <div class="input-group">
                    <input type="hidden" name="date" value="{{$date->toDateString()}}">
                    <input type="text" class="form-control" name="student" placeholder="Search..." value="{{request('student')}}">
                    <button type="submit" class="btn text-light" style="background: #222">Search</button>
                </div>
            </form>


        </div>

    </div>

      <div class="d-flex justify-content-between mb-3">
            <h3>Attendance</h3>
            <div class="me-5">
                @if ($date->greaterThan($earliestDate))
                    <a href="{{ url("/admin/attendances/detail/$classroom->id?date=" . $date->copy()->subDay()->toDateString()) }}" class="btn btn-outline-dark me-2">&larr;</a>
                @endif
                <span>{{ $date->toFormattedDateString() }}</span>
                @if ($date->lessThan(now()->startOfDay()))
                    <a href="{{ url("/admin/attendances/detail/$classroom->id?date=" . $date->copy()->addDay()->toDateString()) }}" class="btn btn-outline-dark ms-2">&rarr;</a>
                @endif
            </div>
      </div>

    </div>
      <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Gender</th>
            <th>Time In</th>
            <th>Time Out</th>
            <th>Status</th>
        </tr>
            @foreach ($students as $student)

                    <tr>
                        <td>{{$student->id}}</td>
                        <td><a href="{{url("admin/students/detail/$student->id")}}" class="text-dark">{{$student->name}}</a></td>
                        <td>{{$student->gender->name}}</td>
                        @if(isset($attendances[$student->id]))
                            @foreach ($attendances[$student->id] as $attendance)
                                <td>{{$attendance->time_in}}</td>
                                <td>{{$attendance->time_out}}</td>
                                <td>{{$attendance->status}}</td>
                            @endforeach

                            @else
                            <td colspan="3">No attendance record</td>
                        @endif
                    </tr>


            @endforeach

      </table>



   <div class="d-flex justify-content-end" style="margin-right: 70px; margin-top: 40px">
        {{$students->links()}}
    </div>


@endsection
