@extends('layouts.admin')

@section('title')
  {{ $exam->name }}
@endsection

@section('header')
  {{ $exam->name }}
@endsection

@section('contents')

@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  {!! implode('', $errors->all('<div>:message</div>')) !!}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif

<div class="card">
  <div class="card-header">
    <div class="card-tools">
      <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#createsTypeForm">
        <i class="fas fa-plus"></i>
      </button>
    </div>
  </div>
  <div class="card-body">
      @foreach ($questionTypes as $questionType)
      <div class="card">
        <div class="card-header bg-primary">
          <h3 class="card-title">
          @if ( $questionType->status )
            <button type="button" class="btn btn-tool text-danger" data-toggle="modal" data-target="#releasesTypeForm"
              onclick="changeReleasesTypeValue( {{ $questionType->id }}, '{{ $questionType->name }}' )">
              <i class="fa fa-door-closed"></i>
            </button>
            {{ $questionType->name }}
          @else
            <button type="button" class="btn btn-tool text-warning" data-toggle="modal" data-target="#releasesTypeForm"
              onclick="changeReleasesTypeValue( {{ $questionType->id }}, '{{ $questionType->name }}' )">
              <i class="fa fa-door-open"></i>
            </button>
            {{ $questionType->name }} {{ $questionType->status ? '' : '(Belum rilis)' }}</h3>
          @endif
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool text-light" data-toggle="modal" data-target="#createsPacketForm"
              onclick="changeCreatesPacketValue( {{ $questionType->id }}, '{{ $questionType->name }}' )">
              <i class="fas fa-plus"></i>
            </button>
            <button type="button" class="btn btn-tool text-light" data-toggle="modal" data-target="#updatesTypeForm"
              onclick="changeUpdatesTypeValue( {{ $questionType->id }}, '{{ $questionType->name }}' )">
              <i class="fas fa-edit"></i>
            </button>
            <button type="button" class="btn btn-tool text-danger" data-toggle="modal" data-target="#deletesTypeForm"
              onclick="changeDeletesTypeValue( {{ $questionType->id }}, '{{ $questionType->name }}' )">
              <i class="fas fa-trash"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="row justify-content-center">
            @foreach ($questionType->packets() as $questionPacket)
            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
              <div class="card">

                <div class="card-header">
                  <h3 class="card-title">{{ $questionPacket->name }}</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool text-primary" data-toggle="modal" data-target="#updatesPacketForm"
                      onclick="changeUpdatesPacketValue( {{ $questionPacket->id }}, '{{ $questionPacket->name }}',
                                                         {{ $questionPacket->amount }}, {{ $questionPacket->time }} )">
                      <i class="fas fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-tool text-danger" data-toggle="modal" data-target="#deletesPacketForm"
                      onclick="changeDeletesPacketValue( {{ $questionPacket->id }}, '{{ $questionPacket->name }}' )">
                      <i class="fas fa-trash"></i>
                    </button>
                  </div>
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
                    <tr>
                      <td>Status</td>
                      <td class="px-2">:</td>
                      @if( $questionPacket->status )
                        <td class="text-success">Sudah dirilis</td>
                      @else
                        <td class="text-danger">Belum dirilis</td>
                      @endif
                    </tr>
                  </table>
                  <a class="btn btn-primary" style="width:100%;" href="{{ route('admin.question.list', array($exam->slug, $questionPacket->slug)) }}">Lihat</a>
                  <br>
                  @if( $questionPacket->status )
                    <button class="btn btn-danger mt-2" style="width:100%;" data-toggle="modal" data-target="#releasesPacketForm"
                      onclick="changeReleasesPacketValue( {{ $questionPacket->id }}, '{{ $questionPacket->name }}' )">
                      Tarik Paket Soal
                    </button>
                  @else
                    <button class="btn btn-warning mt-2" style="width:100%;" data-toggle="modal" data-target="#releasesPacketForm"
                      onclick="changeReleasesPacketValue( {{ $questionPacket->id }}, '{{ $questionPacket->name }}' )">
                      Rilis Paket Soal
                    </button>
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

<!-- Creates's Type Form Modal-->
<div class="modal fade" id="createsTypeForm" tabindex="-1" aria-labelledby="createsTypeFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createsTypeFormLabel">Tambahkan Jenis Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('questiontype.create') }}">
        @csrf
        <div class="modal-body">
          <input type="number" name="exam_type_id" value="{{ $exam->id }}" hidden>
          <div class="mb-3">
            <label for="questionTypeName" class="form-label">Nama Jenis Soal</label>
            <input type="text" class="form-control" id="questionTypeName" name="name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update's Type Form Modal-->
<div class="modal fade" id="updatesTypeForm" tabindex="-1" aria-labelledby="updatesTypeFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatesTypeFormLabel">Edit Jenis Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('questiontype.update') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="questionTypeIdUpdate" name="id" hidden>
          <div class="mb-3">
            <label for="questionTypeName" class="form-label">Nama Jenis Soal</label>
            <input type="text" class="form-control" id="questionTypeNameUpdate" name="name">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ganti</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete's Type Form Modal-->
<div class="modal fade" id="deletesTypeForm" tabindex="-1" aria-labelledby="deletesTypeFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletesTypeFormLabel">Hapus Jenis Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('questiontype.delete') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="questionTypeIdDelete" name="id" hidden>
          <p>Yakin ingin menghapus jenis soal <span id="questionTypeNameDelete"></span>?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Release's Type Form Modal-->
<div class="modal fade" id="releasesTypeForm" tabindex="-1" aria-labelledby="releasesTypeFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="releasesTypeFormLabel">Ubah Status Rilis Jenis Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('questiontype.release') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="questionTypeIdRelease" name="id" hidden>
          <p>Yakin ingin mengubah status rilis jenis soal <span id="questionTypeNameRelease"></span>?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Ubah Status</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Creates's Packet Form Modal-->
<div class="modal fade" id="createsPacketForm" tabindex="-1" aria-labelledby="createsPacketFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createsPacketFormLabel">Tambahkan Paket Soal di Jenis Soal <span id="questionPacketTypeNameCreate"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('questionpacket.create') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="questionPacketTypeIdCreate" name="question_type_id" hidden>
          <div class="mb-3">
            <label for="questionPacketName" class="form-label">Nama Paket Soal</label>
            <input type="text" class="form-control" id="questionPacketName" name="name">
          </div>
          <div class="mb-3">
            <label for="questionPacketAmount" class="form-label">Jumlah Soal</label>
            <input type="number" class="form-control" id="questionPacketAmount" name="amount">
          </div>
          <div class="mb-3">
            <label for="questionPacketTime" class="form-label">Lama Pengerjaan Paket Soal</label>
            <input type="number" class="form-control" id="questionPacketTime" name="time">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Tambahkan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update's Packet Form Modal-->
<div class="modal fade" id="updatesPacketForm" tabindex="-1" aria-labelledby="updatesPacketFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updatesPacketFormLabel">Edit Paket Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('questionpacket.update') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="questionPacketIdUpdate" name="id" hidden>
          <div class="mb-3">
            <label for="questionPacketNameUpdate" class="form-label">Nama Paket Soal</label>
            <input type="text" class="form-control" id="questionPacketNameUpdate" name="name">
          </div>
          <div class="mb-3">
            <label for="questionPacketAmountUpdate" class="form-label">Jumlah Soal</label>
            <input type="number" class="form-control" id="questionPacketAmountUpdate" name="amount">
          </div>
          <div class="mb-3">
            <label for="questionPacketTimeUpdate" class="form-label">Lama Pengerjaan Paket</label>
            <input type="number" class="form-control" id="questionPacketTimeUpdate" name="time">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Ganti</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Delete's Packet Form Modal-->
<div class="modal fade" id="deletesPacketForm" tabindex="-1" aria-labelledby="deletesPacketFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletesPacketFormLabel">Hapus Paket Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('questionpacket.delete') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="questionPacketIdDelete" name="id" hidden>
          <p>Yakin ingin menghapus jenis soal <span id="questionPacketNameDelete"></span>?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger">Hapus</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Release's Packet Form Modal-->
<div class="modal fade" id="releasesPacketForm" tabindex="-1" aria-labelledby="releasesPacketFormLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="releasesPacketFormLabel">Ubah Status Rilis Paket Soal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('questionpacket.release') }}">
        @csrf
        <div class="modal-body">
          <input type="number" id="questionPacketIdRelease" name="id" hidden>
          <p>Yakin ingin mengubah status rilis paket soal <span id="questionPacketNameRelease"></span>?</p>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-warning">Ubah Status</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('topscripts')
<!-- Question Type -->
<script type="text/javascript">
  function changeUpdatesTypeValue( id, name )
  {
    let questionTypeId = document.getElementById("questionTypeIdUpdate");
    let questionTypeName = document.getElementById("questionTypeNameUpdate");

    questionTypeId.value = id;
    questionTypeName.value = name;
  }

  function changeDeletesTypeValue( id, name )
  {
    let questionTypeId = document.getElementById("questionTypeIdDelete");
    let questionTypeName = document.getElementById("questionTypeNameDelete");

    questionTypeId.value = id;
    questionTypeName.innerHTML = name;
  }

  function changeReleasesTypeValue( id, name )
  {
    let questionTypeId = document.getElementById("questionTypeIdRelease");
    let questionTypeName = document.getElementById("questionTypeNameRelease");

    questionTypeId.value = id;
    questionTypeName.innerHTML = name;
  }
</script>
@endpush

@push('topscripts')
<!-- Question Packet -->
<script type="text/javascript">
  function changeCreatesPacketValue( typeId, typeName )
  {
    let questionPacketTypeId = document.getElementById("questionPacketTypeIdCreate");
    let questionPacketTypeName = document.getElementById("questionPacketTypeNameCreate");

    questionPacketTypeId.value = typeId;
    questionPacketTypeName.innerHTML = typeName;
  }

  function changeUpdatesPacketValue( id, name, amount, time )
  {
    let questionPacketId = document.getElementById("questionPacketIdUpdate");
    let questionPacketName = document.getElementById("questionPacketNameUpdate");
    let questionPacketAmount = document.getElementById("questionPacketAmountUpdate");
    let questionPacketTime = document.getElementById("questionPacketTimeUpdate");

    questionPacketId.value = id;
    questionPacketName.value = name;
    questionPacketAmount.value = amount;
    questionPacketTime.value = time;
  }

  function changeDeletesPacketValue( id, name )
  {
    let questionPacketId = document.getElementById("questionPacketIdDelete");
    let questionPacketName = document.getElementById("questionPacketNameDelete");

    questionPacketId.value = id;
    questionPacketName.innerHTML = name;
  }

  function changeReleasesPacketValue( id, name )
  {
    let questionPacketId = document.getElementById("questionPacketIdRelease");
    let questionPacketName = document.getElementById("questionPacketNameRelease");

    questionPacketId.value = id;
    questionPacketName.innerHTML = name;
  }
</script>
@endpush