@extends('layouts.app')

@section('content')
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2>Lambarasa Education</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In augue tortor, tempor at fermentum non, consectetur a enim. 
          Sed orci purus, vehicula vitae luctus a, porta sit amet leo. Phasellus et varius nibh. In consectetur, dolor vel pulvinar 
          eleifend, dui tortor laoreet urna, ac ullamcorper erat sem in nulla. Aliquam non turpis ipsum.</p>
        <a href="{{ route('register') }}" class="btn btn-primary" >DAFTAR SEKARANG</A>
      </div>
      <div class="col-md-6">
        <img class="img-fluid" src="{{ asset('img/photo1.png') }}">
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-light">
  <div class="container">
    <div class="row">
    <div class="col-md-6">
        <img class="img-fluid" src="{{ asset('img/photo2.png') }}">
      </div>
      <div class="col-md-6">
        <h2>Kelebihan Lambarasa Education</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In augue tortor, tempor at fermentum non, consectetur a enim. 
          Sed orci purus, vehicula vitae luctus a, porta sit amet leo. Phasellus et varius nibh. In consectetur, dolor vel pulvinar 
          eleifend, dui tortor laoreet urna, ac ullamcorper erat sem in nulla. Aliquam non turpis ipsum.</p>
      </div>
    </div>
  </div>
</section>
@endsection