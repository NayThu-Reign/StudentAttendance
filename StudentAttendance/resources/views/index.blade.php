@extends('layouts.navbar');

@section('content')
    <div class="container">
        <div class="mb-5">
            <h4>Your Grade - {{$student->grade->name}}</h4>
            <h4>Your Class - Classroom {{$student->classroom->name}}</h4>
        </div>

        <div class="d-flex justify-content-between mb-5">
            <h3>Attendance</h3>
            <div class="me-5">
                @if ($date->greaterThan($earliestDate))
                    <a href="{{ url("/?date=" . $date->copy()->subDay()->toDateString()) }}" class="btn btn-outline-dark me-2">&larr;</a>
                @endif
                <span>{{ $date->toFormattedDateString() }}</span>
                @if ($date->lessThan(now()->startOfDay()))
                    <a href="{{ url("/?date=" . $date->copy()->addDay()->toDateString()) }}" class="btn btn-outline-dark ms-2">&rarr;</a>
                @endif
            </div>
        </div>

        <table class="table table-striped table-bordered">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Time In</th>
                <th>Time Out</th>
            </tr>

            <tr>
                <td>{{$student->id}}</td>
                <td>{{$student->name}}</td>

                @if ($studentAttendance && $studentAttendance->where('date', $date->toDateString())->first())
                    <td>
                        {{ $studentAttendance->where('date', $date->toDateString())->first()->time_in }}
                    </td>
                @elseif ($date->isToday())
                   <td class="d-flex  justify-content-center">
                        <form method="POST" action="{{ route('time-in') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary">Time In</button>
                        </form>
                   </td>

                @endif

                @if ($studentAttendance->where('date', $date->toDateString())->first())
                    @if ($studentAttendance->where('date', $date->toDateString())->first()->time_in && !$studentAttendance->where('date', $date->toDateString())->first()->time_out)
                        <td class="d-flex justify-content-center">
                            <form method="POST" action="{{ route('time-out') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Time Out</button>
                            </form>
                        </td>
                    @else
                        <td> {{ $studentAttendance->where('date', $date->toDateString())->first()->time_out }} </td>
                    @endif
                @endif

            </tr>


                @foreach ($classmates as $classmate)
                    <tr>
                        <td>{{ $classmate->id }}</td>
                        <td>{{ $classmate->name }}</td>
                        @if(isset($classmateAttendances[$classmate->id]))
                            @foreach ($classmateAttendances[$classmate->id] as $att)
                                <td>{{ $att->time_in }}</td>
                                <td>{{ $att->time_out }}</td>
                            @endforeach
                        @else
                            <td></td>
                            <td></td>
                        @endif
                    </tr>
                @endforeach

          </table>


       </div>

    </div>
@endsection
