<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TRYOUT {{ $questionPacket->name }} | Lambarasa</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
  <!-- lambarasa Custom CSS -->
  <link rel="stylesheet" href="{{ asset('css/lambarasa.css') }}">

</head>
<body class="pt-2">

<div class="container">
  <div class="card">
    <div class="card-header">
      <h4 class="text-primary"><strong>INSTRUKSI PENGERJAAN</strong></h4>
    </div>
    <div class="card-body">
      <h5>Paket Tryout : {{ $questionPacket->name }}</h5>
      <p><strong>PETUNJUK 1: CARA PENGERJAAN TRYOUT</strong></p>
      <p>Pilih jawaban yang paling benar (A, B, C, D, atau E).</p>
      <p><strong>PETUNJUK 2: CARA MENGIKUTI TRYOUT</strong></p>
      <ol class="pl-3">
        <li>Kerjakan semua sesi <strong>TRYOUT</strong> sehingga nilai Anda akan keluar.</li>
        <li>Kerjaka <strong>TRYOUT</strong> sesuai waktu yang telah ditentukan. Apabila soal sudah diakses, maka tidak bisa keluar dari pengerjaan.</li>
        <li>Anda bisa mengerjakan <strong>TRYOUT</strong> ini pada rentang waktu bebas namun sesuai dengan timer.</li>
        <li>Kerjakan <strong>TRYOUT</strong> dengan jujur dan teliti.</li>
        <li>Halaman pengerjaan sudah responsif. Jika tampilan pada perangkat Anda kurang rapi/sesuai, kami merekomendasikan untuk menggunakan Laptop/PC.</li>
      </ol>

      <p><strong>PETUNJUK 3: KETERANGAN WARNA TOMBOL NOMOR</strong></p>
      <p><span><button class="btn btn-number active">1</button></span> Soal sedang ditampilkan</p>
      <p><span><button class="btn btn-number">1</button></span> Soal belum dijawab</p>
      <p><span><button class="btn btn-number answered">1</button></span> Soal telah dijawab</p>
      <p><span><button class="btn btn-number flag">1</button></span> Soal ditandai</p>

      <div class="form-check ml-1">
        <input class="form-check-input" type="checkbox" id="agreement" onchange="document.getElementById('submitButton').disabled = !this.checked;">
        <label class="form-check-label" for="agreement">
          Saya telah membaca dan memahami instruksi di atas.
        </label>
      </div>
      
      <form class="pt-3" method="get" action="{{ route('test.start', array($exam->slug, $questionPacket->slug)) }}">
        <div class="text-center pt-2">
          <button type="submit" id="submitButton" class="btn btn-primary" disabled>Mulai mengerjakan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.js') }}"></script>
<!-- Lambarasa Custom JS -->
<script src="{{ asset('js/lambarasa.js') }}"></script>

</body>
</html>
