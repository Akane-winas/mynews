@extends('layouts.front')

@section('title', 'Help Center')

@section('content')
<div class="container">
  <div class="row">
    <h1>Help Center</h1>
  </div>
  <hr color="#c0c0c0">
  <div class="row">
    <div class="headline col-md-12 mx-auto">
      <div class="contents">
        <ul>
          <li>About mynews</li>
          <li>FAQ</li>
          <li>Contact</li>
        </ul>
      </div>
    </div>
  </div>
  <hr color="#c0c0c0">
  {{-- contents --}}
  <div class="row">
    <div class="contents col-md-12">
      <div class="col-md-4">
        <h2>About mynews</h2>
        <p>kkkkkkk</p>
      </div>
      <hr color="#c0c0c0">

      <div class="faq col-md-4">
        <h2>FAQ</h2>
         <section>
           <h4>Q1:~~~~~~?</h4>
           <p>A1:~~~~~~~!</p>
         </section>
         <section>
           <h4>Q2:---------?</h4>
           <p>A2:-----------!</p>
         </section>
         <section>
           <h4>Q3:.........?</h4>
            <p>A3:...........!</p>
         </section>
      </div>
      <hr color="#c0c0c0">

      <div class="contact col-md-4">
        <h2>Contact Form</h2>
        <form action="{{ action('HelpController@confirm') }}" method="post">
          @csrf

          @if (count($errors) > 0)
              <ul>
                @foreach($errors->all() as $e)
                 <li>{{ $e }}</li>
                @endforeach
              </ul>
          @endif
          <div class="form-group">
              <label>Name</label>
              <input type="text" name="name" value="{{ old('name') }}">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="mail" name="email" value="{{ old('email') }}">
          </div>
          <div class="form-group">
            <label>Question</label>
            <textarea class="text" name="question">{{ old('question') }}</textarea>
          </div>
          <input type="submit" class="btn btn-primary" value="confirm" >
        </div>
      </div>
  </div>
</div>
</div>
@endsection
