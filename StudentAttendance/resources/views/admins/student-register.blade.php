@extends('layouts.sidebar')

@section('content')
<div class="container">

    @if (session('info'))
        <div class="alert alert-info">
            {{ session('info') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-warning">
            {{ session('error') }}
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="mb-4">Add New Student</h3>
            <form method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Email</label>
                    <input type="text" name="email" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Gender</label>
                    <select name="gender_id" class="form-select">
                        @foreach ($genders as $gender)
                            <option value="{{ $gender->id }}">
                                {{ $gender->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Grade</label>
                    <select name="grade_id" class="form-select">
                        @foreach ($grades as $grade)
                            <option value="{{ $grade->id }}">
                                {{ $grade->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>CLassroom</label>
                    <select name="classroom_id" class="form-select">
                        @foreach ($classrooms as $classroom)
                            <option value="{{ $classroom->name }}">
                                {{ $classroom->name  }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-2">
                    <label>Father Name</label>
                    <input type="text" name="father_name" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Address</label>
                    <textarea name="address" class="form-control" required></textarea>
                </div>
                <div class="mb-2">
                    <label>PhoneNumber</label>
                    <input type="text" name="phone_no" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="mb-2">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <input type="file" name="image" class="form-control">
                </div>
                <button type="submit" class="btn text-light" style="background: #222;">Add Student</button>

            </form>
        </div>
    </div>
</div>
@endsection
