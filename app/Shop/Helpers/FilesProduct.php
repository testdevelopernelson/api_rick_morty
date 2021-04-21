<?php

namespace App\Shop\Helpers;


use Illuminate\Support\Facades\Storage;
/**
 * 
 */
class FilesProduct
{
	protected $product;


	public function gallery($codigo){
			$array_images = [];
      $array = Storage::disk('images_product')->allFiles();
      foreach ($array as $key => $item) {
      		$resp = strpos($item, $codigo);
            if($resp !== false){
                 $array_images[] = $item;
          }
      }
     	return $array_images;
	}

	public function image_main($codigo){
      $array = $this->gallery($codigo);
      $image_main = '';
   	 	if (count($array) > 0) {
   	 		if (count($array) > 1) {
   	 			$image_main = $array[count($array) - 1];
   	 		}else{
   	 			$image_main = $array[0];
   	 		}
   	 	}
   	 	return $image_main;
	}

	public function file($codigo){
		$file = '';
   	$array = Storage::disk('file_product')->allFiles();
    foreach ($array as $key => $item) {
    		$resp = strpos($item, $codigo);
          if($resp !== false){
               $file= $item;
               break;
        	}
    }
   	return $file;
	}

}