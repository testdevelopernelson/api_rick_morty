<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {  

	protected $table = 'favorites';
  protected $guarded = [];  
  public $timestamps = false;  


  public function user(){
  	return $this->belongsTo(User::class);
  }
  
}