<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRYOUT {{ $questionPacket->name }} Started | Lambarasa</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- lambarasa Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/lambarasa.css') }}">
  <!-- KaTeX style -->
  <link rel="stylesheet" href="{{ asset('plugins/katex/katex.min.css') }}">

</head>
<body class="p-3">
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
              <button class="btn btn-option my-2 answer{{$i}} {{ $answer->id == $userAnswers[$i-1]->question_answer_id ? 'active' : '' }}"
                onclick="updateAnswer( {{ $questions[$i-1]->id }}, {{ $answer->id }}, this, {{ $i }} )">
                <div class="row">
                  <div class="col-1">{{ $option }}</div>
                  <div class="col" id="answer{{$i}}{{$option}}">{!! $answer->answer !!}</div>
                </div>
              </button>
            </div>
          
            @php
              $option++;
            @endphp
          @endforeach
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

    <div class="text-center">
      <h4>Sisa Waktu</h4>
    </div>
    <!-- Timer -->
    <table class="text-center">
      <thead>
        <th class="p-0"><h2 class="font-weight-bolder p-0" id="timerHour">00</h2</th>
        <th class="p-0"><h2 class="font-weight-bolder p-0">:</h2</th>
        <th class="p-0"><h2 class="font-weight-bolder p-0" id="timerMinute">00</h2</th>
        <th class="p-0"><h2 class="font-weight-bolder p-0">:</h2</th>
        <th class="p-0"><h2 class="font-weight-bolder p-0" id="timerSecond">00</h2</th>
      </thead>
      <tbody>
        <td><p>Jam</p></td>
        <td></td>
        <td><p>Menit</p></td>
        <td></td>
        <td><p>Detik</p></td>
      </tbody>
    </table>

      <!-- Number Button -->
      <div class="card-body">
        @for( $i = 1 ; $i <= $questions->count() ; $i++ )
          <button id="number{{$i}}" onclick="loadQuestion( {{ $i }} )" class="btn btn-number {{ $i == 1 ? 'active' : '' }}">{{ $i }}</button>
        @endfor

        <div class="text-center mt-5">
          <button class="btn btn-danger" data-toggle="modal" data-target="#endTestModal">Kumpulkan</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- End Test Modal-->
<div class="modal fade" id="endTestModal" tabindex="-1" aria-labelledby="endTestModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="endTestModalLabel">Konfirmasi Pengumpulan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Yakin ingin mengumpulkan dan menyelesaikan tryout ini?</p>
      </div>
      <div class="modal-footer">
        <a href="{{ route('test.result', array($exam->slug, $questionPacket->slug) ) }}" class="btn btn-danger">Kumpulkan</a>
      </div>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script> $.widget.bridge('uibutton', $.ui.button) </script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js') }}"></script>
<!-- Lambarasa Custom JS -->
<script src="{{ asset('js/lambarasa.js') }}"></script>

<script type="text/javascript">
  function loadQuestion(number)
  {
    $(".questionPanel").css("display", "none");
    $("#questionPanel"+number).css("display", "initial");

    $(".btn-number").removeClass("active");
    $("#number"+number).addClass("active");
  }
</script>

<script type="text/javascript">
  // Set a valid end date
  var countDownDate = new Date("{{ $endedAt }} GMT+07:00").getTime();

  // Update the count down every 1 second
  var x = setInterval(function() {

    // Get today's date and time
    var now = new Date().getTime();

    // Find the distance between now and the countdown date
    var distance = countDownDate - now;

    // Calculate Remaining Time
    var hours = Math.floor( distance / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    // Display the result in the element with id="demo"
    document.getElementById("timerHour").innerHTML = ("0" + hours).slice(-2);
    document.getElementById("timerMinute").innerHTML = ("0" + minutes).slice(-2);
    document.getElementById("timerSecond").innerHTML = ("0" + seconds).slice(-2);

    // If the countdown is finished, write some text
    if (distance < 0) {
      window.location.replace("{{ route('test.result', array($exam->slug, $questionPacket->slug) ) }}");
    }
  }, 1000);
</script>

<script type="text/javascript">
  function updateAnswer(question_id, answer_id, elem, number)
  {
    let currentActive = $('.answer'+number+'.active');
    var CSRF_TOKEN = '{{ csrf_token() }}';

    $.ajax({
      url: '{{ route('answer.update') }}',
      type: 'POST',
      timeout: 5000,
      data: {
        _token: CSRF_TOKEN,
        question_id: question_id,
        question_answer_id: answer_id,
      },
      error: function (data) {
        alert('Jaringan bermasalah, tidak dapat mengupdate jawaban nomor '+number+'.');
        currentActive.addClass("active");
        elem.classList.remove("active");
      },
    });

    currentActive.removeClass("active");
    elem.classList.add("active");
  }
</script>
</body>
</html>
