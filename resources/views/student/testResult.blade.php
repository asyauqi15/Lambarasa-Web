@extends('layouts.student')

@section('title')
Hasil {{ $questionPacket->name }}
@endsection

@section('header')
Hasil {{ $questionPacket->name }}
@endsection

@section('contents')
<div class="card">
  <div class="card-body">
    <div class="row">
      <div class="col-md-6">
        <table class="table table-borderless text-align-middle">
          <tr>
            <td>Nama paket soal</td>
            <td>: {{ $questionPacket->name }}</td>
          </tr>
          <tr>
            <td>Diselesaikan pada</td>
            <td>: {{ date('d F Y', strtotime($userQuestionPacket->updated_at)) }}</td>
          </tr>
          <tr>
            <td>Jumlah soal</td>
            <td>: {{ $questions->count() }}</td>
          </tr>
          <tr>
            <td>Jumlah jawaban benar</td>
            <td>: {{ $userQuestionPacket->trueAnswer }}</td>
          </tr>
          <tr>
            <td>Jumlah jawaban salah</td>
            <td>: {{ $userQuestionPacket->falseAnswer }}</td>
          </tr>
          <tr>
            <td>Jumlah soal tidak dijawab</td>
            <td>: {{$userQuestionPacket->nullAnswer }}</td>
          </tr>
        </table>
      </div>
      <div class="col-md-6 text-center">
        <div class="py-3">
          <h3>SCORE</h3>
          <h1><strong>{{ $userQuestionPacket->score * 100 }}%</strong></h1>
        </div>
        <div class="py-3">
          <a href="{{ route('test.discussion', array($exam->slug, $questionPacket->slug) ) }}" class="btn btn-primary">Lihat Pembahasan</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection