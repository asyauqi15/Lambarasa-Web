@extends('layouts.student')

@section('title')
  {{ $exam->name }}
@endsection

@section('header')
  {{ $exam->name }}
@endsection

@section('contents')

<div class="card">
  <div class="card-body">
      @foreach ($questionTypes as $questionType)
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title">{{ $questionType->name }}</h3>
        </div>
        <div class="card-body">
          <div class="row justify-content-center">
            @foreach ($questionType->packets()->where('status', 1) as $questionPacket)
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
              <div class="card">

                <div class="card-header">
                  <h3 class="card-title">{{ $questionPacket->name }}</h3>
                </div>

                <div class="card-body">
                  <img class="card-img" src="{{ asset('img/default-150x150.png') }}" alt="Card image cap">
                </div>

                <div class="card-footer bg-transparent text-center">
                  <table class="text-left ml-1 mb-3">
                    <tr>
                      <td>Jumlah soal</td>
                      <td class="px-2">:</td>
                      <td>{{ $questionPacket->questions()->count() }}</td>
                    </tr>
                    <tr>
                      <td>Waktu pengerjaan</td>
                      <td class="px-2">:</td>
                      <td>{{ $questionPacket->time }} Menit</td>
                    </tr>
                  </table>
                  @if ( !$questionPacket->getUserPacket( Auth::user()->id )->completed )
                    <a class="btn btn-primary" style="width:100%;" href="{{ route('questionpacket.instruction', array($exam->slug, $questionPacket->slug)) }}">Kerjakan</a>
                  @else
                    <a class="btn btn-outline-primary" style="width:100%;" href="{{ route('test.result', array($exam->slug, $questionPacket->slug) ) }}">Lihat Hasil</a>
                  @endif
                </div>

              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
      @endforeach

  </div>
</div>
@endsection