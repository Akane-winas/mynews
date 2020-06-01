{{-- layouts/admin.blade.phpを読み込む --}}
@extends('layouts.profile')

{{-- admin.blade.phpの@yield('title')に'プロフィール作成'を埋め込む--}}
@section('title', 'Myプロフィール')

{{-- profile.blade.phpの@yield('content')に以下のタグを埋め込む--}}
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2>プロフィールの編集</h2>
        <form action="{{ action('Admin\ProfileController@update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $profile_form->id }}">

        @if (count($errors) > 0)
            <ul>
               @foreach($errors->all() as $e)
                  <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif

          <div class="form-group row">
            <label class="col-md-2" for="name">氏名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="name" value={{ old('name') }}>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2" for="gender">性別</label>
            <div class="col-md-10">
            {{-- ラジオボタンの場合 --}}
            @foreach($genders = array('女性', '男性') as $key => $gender)
								<input type="radio"  name="gender" value="{{ $key }}" {{ old('gender') == $key ? 'checked' : '' }}>
                <label class="col-md-2" for="gender">{{ $gender }}</label>
            @endforeach

            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2" for="hobby">趣味</label>
            <div class="col-md-10">
              <textarea class="form-control" name="hobby" row="20">{{ old('hobby') }}</textarea>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-md-2" for="introduction">自己紹介欄</label>
            <div class="col-md-10">
              <textarea class="form-control" name="introduction" row="20">{{ old('introduction') }}</textarea>
            </div>
          </div>

          <input type="submit" class="btn btn-primary" value="更新">
        </form>
        <div class="row mt-5">
          <div class="col-md-4 mx-auto">
            <h2>編集履歴</h2>
            <ul class="list-group">
              @if ($profile_form->profile_histories != NULL)
                 @foreach ($profile_form->profile_histories as $history)
                  <li class="list-group-item">{{ $history->edited_at }}</li>
                @endforeach
              @endif
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>



@endsection
