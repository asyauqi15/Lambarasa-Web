@extends('layouts.student')

@section('title')
  {{ $questionPacket->name }}
@endsection

@section('contents')
<div class="row">

@for ($i = 1 ; $i <= $questions->count() ; $i++)
  <div class="col-md-8 col-lg-9 col-xl-10 pb-3 questionPanel" id="questionPanel{{ $i }}" style="{{ $i == 1 ? '' : 'display:none' }}">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ $questionPacket->name }} - Soal nomor {{ $i }}</h3>
      </div>
      <div class="card-body">
        <div id="question{{ $i }}">{!! $questions[$i-1]->question !!}</div>

        <div class="row">
          @php
            $option = 'A';
          @endphp

          @foreach ($questions[$i-1]->answers() as $answer)
            <div class="col-sm-12 col-md-6">
              @if( $answer->id == $questions[$i-1]->question_answer_id && $answer->id == $userAnswers[$i-1]->question_answer_id )
              <div class="rounded bg-success pt-3 pb-2 px-3 my-2">
              @elseif ( $answer->id == $questions[$i-1]->question_answer_id )
              <div class="rounded bg-primary pt-3 pb-2 px-3 my-2">
              @elseif ( $answer->id == $userAnswers[$i-1]->question_answer_id )
              <div class="rounded bg-danger pt-3 pb-2 px-3 my-2">
              @else
              <div class="rounded bg-light pt-3 pb-2 px-3 my-2">
              @endif
                <div class="row">
                  <div class="col-1">{{ $option }}</div>
                  <div class="col" id="answer{{$i}}{{$option}}">{!! $answer->answer !!}</div>
                </div>
              </div>
            </div>
          
            @php
              $option++;
            @endphp
          @endforeach
        </div>
        <hr>

        <p><b>Penjelasan</b><p>
        <div class="row">
          <div class="col-12">
            <div id="explanation{{$i}}">{!! $questions[$i-1]->explanation !!}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col text-left">
        @if ($i > 1 )
          <button class="btn btn-primary" onclick="loadQuestion( {{ $i-1 }} )">Sebelumnya</button>
        @endif
      </div>
      <div class="col text-right">
        @if ( $i < $questions->count() )
          <button class="btn btn-primary" onclick="loadQuestion( {{ $i+1 }} )">Selanjutnya</button>
        @endif
      </div>
    </div>
  </div>
  @endfor

  <div class="col-md-4 col-lg-3 col-xl-2">
    <div class="card py-3">
      <!-- Number Button -->
      <div class="card-body">
        @for( $i = 1 ; $i <= $questions->count() ; $i++ )
          <button id="number{{$i}}" onclick="loadQuestion( {{ $i }} )" class="btn btn-number {{ $i == 1 ? 'active' : '' }}">{{ $i }}</button>
        @endfor
      </div>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/katex/katex.min.css') }}">
@endpush

@push('bottomscripts')
<script type="text/javascript">
  function loadQuestion(number)
  {
    $(".questionPanel").css("display", "none");
    $("#questionPanel"+number).css("display", "initial");

    $(".btn-number").removeClass("active");
    $("#number"+number).addClass("active");
  }
</script>
@endpush