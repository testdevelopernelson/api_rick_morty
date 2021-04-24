<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FrontController extends Controller {

    public function home(){
      $user = null;
      if (auth()->check()) {
            $user = User::where('id', auth()->id())->with('favorites')->first();
      }
     return view('pages.home', compact('user'));
    }
     
}
