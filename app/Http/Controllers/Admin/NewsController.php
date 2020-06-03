<?php

//名前空間
namespace App\Http\Controllers\Admin;
//継承するコントーラーの読み込み
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

//News Modelを扱えるようにする
use App\News;
use App\History;
use Carbon\Carbon;
use Storage;
//コントローラークラスを継承する
class NewsController extends Controller
{
    public function add()
    {
      return view('admin.news.create');
    }

    public function create (Request $request)
    {

      //Validationを行う
      $this->validate($request, News::$rules);

      $news = new News;
      $form = $request->all();

      //フォームから画像が送信されてきたら、保存して、$news->image_path に画像を保存する
      if (isset($form['image'])){
        $path = Storage::disk('s3')->putFile('/', $form['image'],'public');
        $news->image_path = Storage::disk('s3')->url($path);
      }else{
        $news->image_path = null;
      }

      //フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      //フォームから送信されてきたimageを削除する
      unset($form['image']);

      //データベースに保存する
      $news->fill($form);
      $news->save();

      //admin/news/createにリダイレクトする
      return redirect('admin/news/create');
    }

    public function index(Request $request)
  {
      $cond_title = $request->cond_title;
      if ($cond_title != '') {
          // 検索されたら検索結果を取得する
          $posts = News::where('title', $cond_title)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = News::all();
      }
      return view('admin.news.index', ['posts' => $posts, 'cond_title' => $cond_title]);
  }

      public function edit(Request $request)
      {
        //News modelからのデータを取得する
        $news = News::find($request->id);
        if (empty($news)) {
          abort(404);
        }
        return view('admin.news.edit', ['news_form' => $news]);
      }

      public function update(Request $request)
      {
        //validationをかける
        $this->validate($request, News::$rules);
        //News Modelからデータを取得する
        $news = News::find($request->id);
        //送信されてきたフォームデータを格納する
        $news_form = $request->all();
        if (isset($news_form['image'])){
          $path = Storage::disk('s3')->putFile('/',$form['image'],'public');
          $news->image_path = Storage::disk('s3')->url($path);
          unset($news_form['image']);
        } elseif (0 == strcmp($request->remove, 'true')) {
          $news->image_path =null;
        }
        unset($news_form['_token']);
        unset($news_form['remove']);

        //該当するデータを上書きして保存する
        $news->fill($news_form)->save();

        //HistoryModelに編集履歴を追加する
        $history = new History;
        $history->news_id = $news->id;
        $history->edited_at = Carbon::now();
        $history->save();

        return redirect('admin/news');
      }

      public function delete(Request $request)
      {
        // 該当するNews Modelを取得
        $news = News::find($request->id);
        // 削除する
        $news->delete();
        return redirect('admin/news/');
      }
}
