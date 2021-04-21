<?php

use App\Models\Section;
use Illuminate\Support\Facades\View;


function set_content($id){
	$section = Section::with('contents')->find($id);
	View::share('section', $section);
	set_seo($section);
}

function set_seo($value){
  View::share('meta_title', $value->meta_title .' | '.config('app.name'));
  View::share('meta_description', $value->meta_description);
  View::share('meta_keywords', $value->meta_keywords);
}

function set_months_large(){
  $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  View::share('meses', $meses);
}

function set_months_short(){
  $meses = array("Ene","Feb","Mar","Abr","May","Jun","Jul","Agos","Sept","Oct","Nov","Dic");
  View::share('meses', $meses);
}

function set_days(){
  $days = array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  View::share('days', $days);
}

if (!function_exists('core')) {
    function core() {
        return app()->make(\App\Shop\Core::class);
    }
}

function set_favorites(){
    $count = 0;
    $favorites = [];
    if(session()->has('favorites')) {
       $favorites = session()->get('favorites');
       $count = count($favorites);
    }
    // dd($favorites);
     View::share('count_favorite', $count);
     View::share('favorites', $favorites);
}





