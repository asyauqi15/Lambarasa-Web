@extends('layouts.admin')

@section('title')
  Soal
@endsection

@section('header')
  Jenis Ujian
@endsection

@section('contents')

@if($errors->any())
  <div class="alert alert-danger" role="alert">
    {!! implode('', $errors->all('<div>:message</div>')) !!}
  </div>
@endif

<div class="card">
  <div class="card-header">
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#createsForm">
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
    <div class="row justify-content-center">

      @foreach ($exams as $exam)
      <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">{{ $exam->name }}</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool text-primary" data-toggle="modal" data-target="#updatesForm"
                onclick="changeUpdatesValue( {{ $exam->id }}, '{{ $exam->name }}' )">
                <i class="fas fa-edit"></i>
              </button>
              <button type="button" class="btn btn-tool text-danger" data-toggle="modal" data-target="#deletesForm"
                onclick="changeDeletesValue( {{ $exam->id }}, '{{ $exam->name }}' )">
                <i class="fas fa-trash"></i>
              </button>
            </div>
          </div>

          <div class="card-body">
            <img class="card-img" src="{{ asset('img/default-150x150.png') }}" alt="Card image cap">
          </div>

          <div class="card-footer bg-transparent text-center">
            <a class="btn btn-primary" href="{{ route('admin.questiontype.list', $exam->slug) }}">Lihat</a>
          </div>

        </div>
      </div>
      @endforeach

    </div>
  </div>
</div>

<!-- Creates's Form Modal-->
<div class="modal fade" id="createsForm" tabindex="-1" aria-labelledby="createsFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createsFormLabel">Tambahkan Jenis Ujian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('examtype.create') }}">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="examName" class="form-label">Nama Ujian</label>
            <input type="text" class="form-control" id="examName" name="name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update's Form Modal-->
<div class="modal fade" id="updatesForm" tabindex="-1" aria-labelledby="updatesFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatesFormLabel">Edit Jenis Ujian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('examtype.update') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="examIdUpdate" name="id" hidden>
          <div class="mb-3">
            <label for="examName" class="form-label">Nama Ujian</label>
            <input type="text" class="form-control" id="examNameUpdate" name="name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ganti</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete's Form Modal-->
<div class="modal fade" id="deletesForm" tabindex="-1" aria-labelledby="deletesFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletesFormLabel">Hapus Jenis Ujian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('examtype.delete') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="examIdDelete" name="id" hidden>
          <p>Yakin ingin menghapus jenis ujian <span id="examNameDelete"></span>?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('topscripts')
<script type="text/javascript">
  function changeUpdatesValue( id, name )
  {
    let examId = document.getElementById("examIdUpdate");
    let examName = document.getElementById("examNameUpdate");

    examId.value = id;
    examName.value = name;
  }

  function changeDeletesValue( id, name )
  {
    let examId = document.getElementById("examIdDelete");
    let examName = document.getElementById("examNameDelete");

    examId.value = id;
    examName.innerHTML = name;
  }
</script>
@endpush