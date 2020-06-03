@extends('layouts.front')

@section('content')
  <div class="container">
    <div class="row">
      <h1>プロフィール一覧<h1>
    </div>
    <hr color="#c0c0c0">
      <div class="posts col-md-8 mx-auto mt-3">

        @foreach($posts as $post)
          <div class="post">
            <div class="row">
              <div class="text col-md-6">
                <div class="date">
                  {{ $post->updated_at->format('Y年m月d日') }}
                </div>
                <div class="name">
                  {{ Str::limit($post->name, 20) }}
                </div>
                <div class="hobby mt-3">
                　{{ Str::limit($post->hobby, 50) }}
                </div>
                <div class="introduction mt-3">
                　{{ Str::limit($post->introduction, 50) }}
                </div>
               </div>
            </div>
          </div>
    <hr color="#c0c0c0">
    @endforeach

      </div>
　　</div>
@endsection
