<?php

namespace App\Shop\Repositories;

use App\Shop\Helpers\FilesProduct;
use App\Models\Product;
use App\Models\Using;
use Illuminate\Support\Str;

class ProductRepository{

	protected $helpersImages;

	public function __construct(){
		$this->helpersFiles = new FilesProduct;
	}	

	public function prepareProducts($products){
			foreach ($products as $key => $product) {
					$product = $this->prepareProduct($product);
			}
			return $products;
	}

	public function prepareProduct($product){
		$product->image_main = $this->helpersFiles->image_main($product->codigo);
		$product->file = $this->helpersFiles->file($product->codigo);
		if ($product->precio == $product->precioespecial) {
			$product->tax_amount = $product->precio * ($product->iva/100);
			$product->price = $product->precio + $product->tax_amount;
			$product->has_price_special = false;
		}else{
			$product->has_price_special = true;
			$product->tax_amount = $product->precioespecial * ($product->iva/100);
			$product->price =  $product->precioespecial + $product->tax_amount;			
		}	
		return $product;
	}

	public function getCalculateDiscount($product){
			$product->price = $product->precioespecial + ($product->precioespecial * ($product->iva/100));
			$precioespecial = $product->precio + ($product->precio * ($product->iva/100));
			$discount_amount = $precioespecial - $product->price;
			$discount_percentage = ($discount_amount * 100) / $precioespecial;
			$product->discount_amount = $discount_amount;
			$product->discount_percentage =  number_format(round($discount_percentage), 0 , '.', '.');
			return $product;
	}

	public function prepareMarcas(){
			$marcas =  Product::where('marca', '!=', null)->where('marca', '!=', '')->orderBy('marca')->select('marca')->distinct()->get();
			$filters_marcas = [];
			foreach ($marcas as $key => $marca) {
					$filters_marcas[] = $this->prepareMarca($marca->marca);
			}
			return $filters_marcas;
	}

	public function prepareMarca($marca){
		$array = [
			'name' => $this->getCamelCase($marca),
			'slug' => Str::slug($marca)
		];
		return $array;
	}

	public function prepareUsos($products){
			$filter_usos = Product::whereIn('codigo', $products)->select('uso')->distinct();       
      $filters_usos = $this->getUsos($filter_usos->get());
			return $filters_usos;
	}

	public function galleryProduct($product){
		$gallery = $this->helpersFiles->gallery($product->codigo);
		return $gallery;
	}	

	private function getUsos($filter_usos){
    $array = [];
    foreach ($filter_usos as $item) {
      if ($item->uso != null) {
        $array[$item->uso] = $item->uso;
      }
    }
    $usings = Using::whereIn('code', $array)->get();
    return $usings;
 	}

	private function getCamelCase($string){
			$camelcase = ucwords(mb_strtolower($string, 'UTF-8'));
			return $camelcase;
	}
}