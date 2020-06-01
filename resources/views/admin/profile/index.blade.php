@extends('layouts.admin')
@section('title', '登録済みプロフィールの一覧')

@section('content')
    <div class="container">
      <div class="row">
        <h2>プロフィール一覧</h2>
        <div class="col-md-8">
          <form action="{{ action('Admin\ProfileController@index') }}" method="get">
            <div class="form-group row">
              <label class="col-md-2">名前</label>
              <div class="col-md-8">
                <input type="text" class="form-control" name="cond_title" value="{{ $cond_title }}">
              </div>
              <div class="col-md-2">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="検索">
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="list-news col-md-12 mx1auto">
          <div class="row">
            <table class="table table-dark">
              <thead>
                <tr>
                  <th width="10%">ID</th>
                  <th width="50%">名前</th>
                  <th width="10%">操作</th>
                </tr>
              </thead>
              <tbody>
                @foreach($posts as $profile)
                  <tr>
                    <th>{{ $profile->id }}</th>
                    <td>{{ $profile->name}}</td>
                    <td>
                      <div>
                        <a href="{{ action('Admin\ProfileController@edit', ['id' => $profile->id]) }}">編集</a>
                      </div>
                      <div>
                        <a href="{{ action('Admin\ProfileController@delete', ['id' => $profile->id]) }}">削除</a>
                      </div>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

@endsection
