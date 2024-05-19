@extends('layouts.sidebar')

@section('content')
   <div class="ms-4">

      <h3 class="mb-3">Admins List</h3>

      <a href="{{ url('/admin/new-admins/create')}}" class="btn text-decoration-none text-light mb-4"  style="background: #222">Add New Admin</a>

      <table class="table table-striped table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
        </tr>
        @foreach ($admins as $admin)

            <tr>
                <td>{{$admin->id}}</td>
                <td>{{$admin->name}}</td>
                <td>{{$admin->email}}</td>
            </tr>


        @endforeach
      </table>

   </div>


   <div class="d-flex justify-content-end" style="margin-right: 70px; margin-top: 40px">
        {{$admins->links()}}
    </div>


@endsection
