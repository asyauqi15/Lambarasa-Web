@extends('layouts.admin')

@section('title')
  {{ $questionPacket->name }}
@endsection

@section('contents')
<div class="row">
  @php
    $i = 1;
  @endphp
  @foreach ($questions as $question)
  <div class="col-md-8 col-lg-9 col-xl-10 questionPanel" id="questionPanel{{ $i }}" style="{{ $i == 1 ? '' : 'display:none' }}">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">{{ $questionPacket->name }} - Soal nomor {{ $i }}</h3>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-11">
            <div id="question{{ $i }}">{!! $question->question !!}</div>
          </div>
          <div class="col-1 p-0">
            <button class="btn text-info" data-toggle="modal" data-target="#editQuestionForm"
              onclick="changeTextAreaValue('#question{{ $i }}')"><i class="fa fa-edit"></i></button>
          </div>
        </div>

        <div class="row">
          @php
            $option = 'A';
          @endphp

          @foreach ($question->answers() as $answer)
            <div class="col-sm-12 col-md-6">
              <div class="row">
                <div class="col-11 pr-0">
                  <button class="btn btn-option my-2 answer{{$i}} {{ $question->question_answer_id == $answer->id ? 'active' : '' }}"
                    onclick="updateTrueAnswer( {{ $question->id }}, {{ $answer->id }}, this, '.answer{{$i}}' )">
                    <div class="row">
                      <div class="col-1">{{ $option }}</div>
                      <div class="col" id="answer{{$i}}{{$option}}">{!! $answer->answer !!}</div>
                    </div>
                  </button>
                </div>
                <div class="col-1 p-0">
                  <button class="btn text-info" data-toggle="modal" data-target="#editAnswerForm" onclick="changeAnswerId('{{$answer->id}}', '#answer{{$i}}{{$option}}')"
                    ><i class="fa fa-edit"></i></button>
                  <button class="btn text-danger" data-toggle="modal" data-target="#deleteAnswerForm" onclick="changeAnswerId('{{$answer->id}}', '#answer{{$i}}{{$option}}')"
                    ><i class="fa fa-trash"></i></button>
                </div>
              </div>
            </div>
          
            @php
              $option++;
            @endphp
          @endforeach

          <div class="col-sm-12 col-md-6">
            <div class="row">
              <div class="col-11 pr-0">
                <button class="btn btn-success text-left pt-3 my-2" data-toggle="modal" data-target="#addAnswerForm" style="width:100%"
                  onclick="resetTextAreaValue()">
                  <div class="row">
                    <div class="col-1"><i class="fa fa-plus"></i></div>
                    <div class="col"><p>Tambah Jawaban</p></div>
                  </div>
                </button>
              </div>
            </div>
          </div>

        </div>

        <hr>

        <p><b>Penjelasan</b><p>
        <div class="row">
          <div class="col-11">
            <div id="explanation{{$i}}">{!! $question->explanation !!}</div>
          </div>
          <div class="col-1 p-0">
            <button class="btn text-info" data-toggle="modal" data-target="#editExplanationForm" 
              onclick="changeTextAreaValue('#explanation{{ $i }}')"><i class="fa fa-edit"></i></button>
          </div>
        </div>
      </div>
    </div>
  </div>

  @php
    $i++
  @endphp
  
  @endforeach

  <div class="col-md-4 col-lg-3 col-xl-2">
    <div class="card">
      <div class="card-body justify-content-center">
        @for( $i = 1 ; $i <= $questions->count() ; $i++ )
          <button onclick="loadQuestion( this, {{ $i }}, {{ $questions[$i-1]->id }} )" class="btn btn-number {{ $i == 1 ? 'active' : '' }}">{{ $i }}</button>
        @endfor
      </div>
    </div>
  </div>
  
</div>

<!-- Edit Question Form Modal -->
<div class="modal fade" id="editQuestionForm" tabindex="-1" aria-labelledby="editQuestionFormLabel" aria-hidden="true">
  <div class="modal-dialog modal-large">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editQuestionFormLabel">Edit pertanyaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('question.update.question') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="questionQuestionId" name="id" value="{{ $questions[0]->id }}">
          <textarea id="questionQuestion" name="question" class="summernote"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Explanation Form Modal -->
<div class="modal fade" id="editExplanationForm" tabindex="-1" aria-labelledby="editExplanationFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editExplanationFormLabel">Edit penjelasan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('question.update.explanation') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="explanationQuestionId" name="id" value="{{ $questions[0]->id }}">
          <textarea id="explanationQuestion" name="explanation" class="summernote"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Add Answer Form Modal -->
<div class="modal fade" id="addAnswerForm" tabindex="-1" aria-labelledby="addAnswerFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addAnswerFormLabel">Tambah jawaban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('questionanswer.create') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="answerQuestionId" name="question_id" value="{{ $questions[0]->id }}">
          <textarea name="answer" class="summernote"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Answer Form Modal -->
<div class="modal fade" id="editAnswerForm" tabindex="-1" aria-labelledby="editAnswerFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editAnswerFormLabel">Edit jawaban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('questionanswer.update') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="answerIdUpdate" name="id">
          <textarea name="answer" class="summernote"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Edit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete Answer Form Modal -->
<div class="modal fade" id="deleteAnswerForm" tabindex="-1" aria-labelledby="deleteAnswerFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteAnswerFormLabel">Edit jawaban</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('questionanswer.delete') }}" method="post">
        @csrf
        <div class="modal-body">
          <input type="hidden" id="answerIdDelete" name="id">
          <p>Yakin ingin menghapus jawaban ini?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('plugins/katex/katex.min.css') }}">
@endpush

@push('bottomscripts')
<script type="text/javascript">
  function loadQuestion(elem, number, id)
  {
    $(".questionPanel").css("display", "none");
    $("#questionPanel"+number).css("display", "initial");

    $("#questionQuestionId").val(id);
    $("#explanationQuestionId").val(id);
    $("#answerQuestionId").val(id);

    $(".btn-number").removeClass("active");
    elem.classList.add("active");
  }

  function changeTextAreaValue(idHTML)
  {
    $(".note-editable").html($(idHTML).html());
  }

  function resetTextAreaValue()
  {
    $(".note-editable").html("<p><br></p>");
  }

  function changeAnswerId(id, idHTML)
  {
    $("#answerIdUpdate").val(id);
    $("#answerIdDelete").val(id);
    $(".note-editable").html($(idHTML).html());
  }
</script>
@endpush

@push('bottomscripts')
<script type="text/javascript">
  function updateTrueAnswer(question_id, answer_id, elem, classHTML)
  {
    var CSRF_TOKEN = $('input[name="_token"]')[0].value;

    $.ajax({
      url: '{{ route('question.update.trueanswer') }}',
      type: 'POST',
      data: {
        _token: CSRF_TOKEN,
        id: question_id,
        question_answer_id: answer_id,
      },
      success: function (status) {
        alert(status);
      },
    });

    $(classHTML).removeClass("active");
    elem.classList.add("active");
  }
</script>
@endpush

@push('bottomscripts')
  <script src="{{ asset('plugins/katex/katex.min.js') }}"></script>
  <script src="{{ asset('plugins/summernote/plugin/math/summernote-math.js') }}"></script>
@endpush

@push('bottomscripts')
<script type="text/javascript">
  $('.summernote').summernote({
    tabsize: 2,
    height: 300,
    toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline', 'italic', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['table', ['table']],
      ['insert', ['link', 'picture', 'video', 'math']],
      ['view', ['fullscreen', 'codeview', 'help']]
    ]
  });
</script>
@endpush