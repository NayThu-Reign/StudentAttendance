@extends('layouts.sidebar')

@section('content')
    <div class="container">
        <h3 class="mb-5">Dashboard</h3>

        <div class="d-flex ms-5" style="gap: 100px">
            <a href="{{ url("/admin/grades/view/all")}}" class="card text-decoration-none" style="width: 250px; height: 100px;">
                <div class="card-body d-flex flex-column align-items-center">
                    <h3 class="card-title mb-2">Grades</h3>
                    <h4 class="card-subtitle text-body-secondary">Total - {{ count($grades)}}</h4>
                </div>

            </a>

            <a href="{{ url("/admin/admins/view")}}" class="card text-decoration-none" style="width: 250px; height: 100px;">
                <div class="card-body d-flex flex-column align-items-center">
                    <h3 class="card-title mb-2">Admins</h3>
                    <h4 class="card-subtitle text-body-secondary">Total - {{ count($admins)}}</h4>
                </div>

            </a>

            <a href="#" class="card text-decoration-none" style="width: 250px; height: 100px;">
                <div class="card-body d-flex flex-column align-items-center">
                    <h3 class="card-title mb-2">Students</h3>
                    <h4 class="card-subtitle text-body-secondary">Total - {{ count($students)}}</h4>
                </div>

            </a>

        </div>
    </div>
@endsection
