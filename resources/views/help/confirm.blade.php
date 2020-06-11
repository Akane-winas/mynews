@extends('layouts.front')
@section('title', 'Confirm')
@section('content')
<div class="container">
  <div class="row">
    <h1>Confirm Form</h1>
  </div>
  <hr color=#c0c0c0>
  <div class="contact col-md-12">
    <form action="{{ action('HelpController@send') }}" method="post">
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
        <input type="text" name="name" value="{{ $form['name'] }}">
      </div>
      <div class="form-group">
        <label>Email</label>
        <input type="text" name="email" value="{{ $form['email'] }}">
      </div>
      <div class="form-group">
        <label>Question</label>
        <input type="textarea" name="question" value="{{ $form['question']}}">
      </div>
      <input type="submit" class="btn btn-primary" value="send" >
    </form>
  </div>
</div>
@endsection
