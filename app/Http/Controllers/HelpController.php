<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class HelpController extends Controller
{
    public function index()
    {

      return view('help.index');
    }

    public function confirm(Request $request)
    {
      $this->validate($request, Contact::$rules);

      $contact = new Contact;
      $form = $request->all();

      return view('help.confirm', compact('form'));
    }

    public function send(Request $request)
    {
      $this->validate($request, Contact::$rules);

      $contact = new Contact;
      $form = $request->all();

      $contact->fill($form);
      $contact->save();
      return redirect('help/');
    }

}
