<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
/**
 * 
 */
class FavoriteController extends Controller
{
	
	public function add_favorite(){
        $all = request()->all();
        $data = $all['codigo'];
        if (session()->has('favorites')) {
            $items = session()->get('favorites'); 
            $items[$all['codigo']] = $data;
            session()->put('favorites', $items);
        }else{
            $items[$all['codigo']]= $data;
            session()->put('favorites', $items);            
        } 
        $response = [
            'status' => true
        ];
        return response()->json($response);
       
    }

    public function remove_favorite(){
        $data = request()->all();
        $codigo = $data['codigo'];      
        if (session()->has('favorites')) {
            $items = session()->get('favorites'); 
            unset($items[$codigo]);
            session()->put('favorites', $items);
        }
        $response = [
            'status' => true
        ];
        return response()->json($response);
    }
}