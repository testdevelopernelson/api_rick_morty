<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Mail;

class AjaxController extends Controller {

    public function cities($dep) {
        $cities = City::where('state_id', $dep)->get()->toArray();
        return response()->json($cities);
    }
    
}
