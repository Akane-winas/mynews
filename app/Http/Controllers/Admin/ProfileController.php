<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Profile;

use App\ProfileHistories;
use Carbon\Carbon;

class ProfileController extends Controller
{
  public function add ()
  {
    return view('admin.profile.create');
  }

  public function create(Request $request)
  {
    // Varidationを行う
      $this->validate($request, Profile::$rules);

      $profile = new Profile;
      $form = $request->all();

      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);

      // データベースに保存する
      $profile->fill($form)->save();



    return redirect('admin/profile/create');
  }

  public function index(Request $request)
  {
    $cond_title= $request->cond_title;
    if ($cond_title != ''){
      // 検索されたら検索結果を取得
      $posts = Profile::where('name', $cond_title)->get();
    }else{
      $posts = Profile::all();
    }
    return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

  public function edit(Request $request)
  {
    $profile = Profile::find($request->id);
    if (empty($profile)) {
      abort(404);
    }

    return view('admin.profile.edit',['profile_form' => $profile]);
  }

  public function update(Request $request)
  {
    $this->validate($request, Profile::$rules);
    // Profile Modelからデータを取得する
    $profile = Profile::find($request->id);
    // 送信されてきたフォームデータを格納する
    $form = $request->all();

    unset($form['_token']);

    //var_dump($form);
    //dd($profile);
    // 該当するデータを上書きして保存する
    $profile->fill($form)->save();

    $history = new ProfileHistories;
    $history->profile_id = $profile->id;
    $history->edited_at = Carbon::now();
    $history->save();

    return redirect('admin/profile');
  }

  public function delete(Request $request)
 {
     // 該当するNews Modelを取得
     $profile = Profile::find($request->id);
     // 削除する
     $profile->delete();
     return redirect('admin/profile/');
 }
}
