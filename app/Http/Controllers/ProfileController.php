<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use illuminate\Support\facades\HTML;

use App\Profile;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
      $cond_name = $request->cond_name;

      if ($cond_name !=''){
        $posts = Profile:: where('name', $cond_name).orderBy('update_at', 'desc')->get();
      }else{
        $posts = Profile::all()->SortByDesc('update_at');
      }
      if (count($posts)>0){
        $headline = $posts->shift();
      }else{
        $headline = null;
      }
      return view('profile.index', ['headline' =>$headline, 'posts' => $posts, 'cond_name' => $cond_name]);
    }
}
