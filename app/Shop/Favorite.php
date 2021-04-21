<?php
use App\Models\Section;
use Illuminate\Support\Facades\View;

function set_content() {
    $args = func_get_args();
    $find = $args[0];
    if (count($args) > 1) {
        $find = $args;
    }
    $section = Section::with('contents')->find($find);
    View::share('section', $section);
    set_seo($section);
}

function set_seo($value) {
    if (!is_a($value, 'Illuminate\Database\Eloquent\Collection')) {
        View::share('meta_title', $value->meta_title . ' | ' . config('settings.shop_name'));
        View::share('meta_description', $value->meta_description);
        View::share('meta_keywords', $value->meta_keywords);
    }
}

if (!function_exists('asset_theme')) {
    // Retorna url del tema seleccionado
    function asset_theme($file) {
        return url(theme_url($file));
    }
}

// Retorna un string con el precio en la moneda configurada
function money($value) {
    return '$' . number_format($value, 0, null, '.');
}

if (!function_exists('core')) {
    function core() {
        return app()->make(\App\NovaCart\Core::class);
    }
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
  $days = array("Domingo", "Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
  View::share('days', $days);
}

function set_favorites(){
    $count = 0;
    $favorites = [];
    if(session()->has('favorites')) {
       $favorites = session()->get('favorites');
       $count = count($favorites);
    }
     View::share('count', $count);
     View::share('favorites', $favorites);
}
