<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;

class AccountController extends Controller {

      
      public function create_account(){
          $data = request()->all();
          if ($user = User::where('email', $data['email'])->first()) {
              return response()->json(['status' => 'exists', 'message' => 'Este correo ya se encuentra registrado']);
          }else{
             $user = User::create($data);
             $user->save();
             return response()->json(['status' => 'save', 'message' => 'La cuenta se ha creado exitósamente']);
          }          
      }

      public function get_user(){
         $user = User::where('id', auth()->id())->with('favorites')->first();
         return response()->json(['status' => true, 'user' => $user]);
      }

      public function update_account(){
          $data = request()->all();
          $object = User::findOrFail($data['id']);
          $object->fill(request()->all());
          $object->save();  
          return response()->json(['status' => 'update', 'message' => 'La información se actualizó exitósamente']);       
      }      
     
      public function add_favorite(){
          $data = request()->all();
          $data['id_usuario'] = auth()->id();          
          $user = User::find(auth()->id());
          $user->favorites()->create($data);
          return response()->json(['status' => 'add', 'message' => 'Agregado correctamente a mis favoritos']);       
      }
      public function delete_favorite($id){ 
          $user = User::find(auth()->id());
          $user->favorites()->where('ref_api', $id)->delete();
          return response()->json(['status' => 'add', 'message' => 'Eliminado correctamente de mis favoritos']);       
      }
}
