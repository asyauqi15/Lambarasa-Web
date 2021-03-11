@extends('layouts.admin')

@section('title')
  {{ $questionPacket->name }}
@endsection

@section('contents')
<div class="row">
  <div class="col-md-8 col-lg-9 col-xl-10">
    <div class="card">
    </div>
  </div>
  <div class="col-md-4 col-lg-3 col-xl-2">
    <div class="card">
      <div class="card-body justify-content-center">
        @for( $i = 1 ; $i <= $questions->count() ; $i++ )
          <button class="btn btn-light btn-number">{{ $i }}</button>
        @endfor
      </div>
    </div>
  </div>
</div>
@endsection