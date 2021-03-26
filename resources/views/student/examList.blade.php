@extends('layouts.student')

@section('title')
  Tryout
@endsection

@section('header')
  Jenis Tryout
@endsection

@section('contents')

@if($errors->any())
  <div class="alert alert-danger" role="alert">
    {!! implode('', $errors->all('<div>:message</div>')) !!}
  </div>
@endif

<div class="card">
  <div class="card-body">
    <div class="row justify-content-center">

      @foreach ($exams as $exam)
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">{{ $exam->name }}</h3>
          </div>

          <div class="card-body">
            <img class="card-img" src="{{ asset('img/default-150x150.png') }}" alt="Card image cap">
          </div>

          <div class="card-footer bg-transparent text-center">
            <table class="text-left ml-1 mb-3">
              <tr>
                <td>Jumlah Tipe Soal</td>
                <td class="px-2">:</td>
                <td>{{ $exam->questionTypes()->where('status', 1)->count() }}</td>
              </tr>
              <tr>
                <td>Jumlah Paket Soal</td>
                <td class="px-2">:</td>
                <td>{{ $exam->packetsReleasedCount() }}</td>
              </tr>
            </table>
            <a class="btn btn-primary" style="width:100%;" href="{{ route('questiontype.list', $exam->slug) }}">Lihat</a>
          </div>

        </div>
      </div>
      @endforeach

    </div>
  </div>
</div>
@endsection