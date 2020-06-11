<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    //
    protected $guarded = array('id');

    public static $rules = array(
      'name' => 'required',
      'email' => 'required|email|alpha_dash',
      'question' => 'required|max:500'
    );
}
