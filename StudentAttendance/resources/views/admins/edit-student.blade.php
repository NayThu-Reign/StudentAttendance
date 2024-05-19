@extends('layouts.sidebar')

@section('content')
<div class="container">

    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{$student->name}}">
                </div>
                <div class="mb-2">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" value="{{$student->email}}">
                </div>
                <div class="mb-2">
                    <label>Gender</label>
                    <select name="grade_id" class="form-select">
                        @foreach ($genders as $gender)
                            <option value="{{ $gender->id }}" @selected($student->gender_id === $gender->id)>
                                {{ $gender->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Grade</label>
                    <select name="grade_id" class="form-select">
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}" @selected($student->grade_id === $grade->id)>
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>CLassroom</label>
                    <select name="classroom_id" class="form-select">
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->name }}" @selected($student->classroom_id === $classroom->id)>
                                {{ $classroom->name  }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Father Name</label>
                    <input type="text" name="father_name" class="form-control" value="{{$student->father_name}}">
                </div>
                <div class="mb-2">
                    <label>Address</label>
                    <textarea name="address" class="form-control">{{$student->address}}</textarea>
                </div>
                <div class="mb-2">
                    <label>PhoneNumber</label>
                    <input type="text" name="phone_no" class="form-control" value="{{$student->phone_no}}">
                </div>
                <div class="mb-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" value="{{$student->password}}">
                </div>
                <div class="mb-2">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="input-group mb-3">
                    <input type="file" name="image" class="form-control" value="{{$student->image}}">
                </div>

                <button type="submit" class="btn text-light" style="background: #222;">Update</button>

            </form>
        </div>
    </div>
</div>
@endsection
