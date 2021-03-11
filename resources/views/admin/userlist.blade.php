@extends('layouts.admin')

@section('title')
User List
@endsection

@section('header')
User List
@endsection

@section('contents')
<div class="card">
  <div class="card-body p-0">
    <div class="table-responsive">
      <table class="table m-0">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nama Lengkap</th>
            <th scope="col">Nama Panggilan</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <th scope="row">{{ $user->id }}</th>
              <td>{{ $user->name }}</td>
              <th>{{ $user->nick_name }}</td>
              <th>{{ $user->email }}</td>
              <th</th>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection