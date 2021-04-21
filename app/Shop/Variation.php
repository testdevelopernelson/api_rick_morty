<?php

namespace App\Shop;

use App\Models\Attribute;
use App\Models\AttributeOption;
use App\Models\AttributeFamily;
use App\Models\Family;
use App\Models\Product;
use App\Models\ProductAttribute; 
use App\Models\ProductDetail;

class Variation {

    public static function setVariations($attributes, $product_id) {
        self::resetVariations($product_id);
        $attributes = Attribute::whereIn('id', $attributes)->orderBy('order')->with('options')->get();
        // dd($attributes);
        foreach ($attributes as $key => $attr) {
          $options[] = $attr->options()->pluck('id', 'id');
        }
        $family = self::createFamily($attributes, $product_id);
        $variations = self::getCombinations($options);
        
        // dd($variations);
        foreach ($variations as $key => $var) {
            $insertOpts = [];
            $prodAttr = ProductAttribute::create([
                'product_id' => $product_id,
                'product_attr_name' => '',
            ]);
            $name = '';
            foreach ($var as $opt_id) {
                $insertOpts[] = [
                    'product_attribute_id' => $prodAttr->id,
                    'attribute_option_id' => $opt_id,
                ];
                $attrOption = AttributeOption::find($opt_id);
                $name .= $attrOption->name . ' - ';
            }
            $name = substr($name, 0, -2);
            ProductDetail::insert($insertOpts);
            $prodAttr->product_attr_name = $name;
            $prodAttr->save();
        }
    }

    public static function getCombinations($arrays) {
        $result = array(array());
        foreach ($arrays as $property => $property_values) {
            $tmp = array();
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, array($property => $property_value));
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    public static function addVariation($opts, $product_id) {
        $opts = array_filter($opts);
        if (self::existsVariation($opts, $product_id)) {
            return false;
        }

        $prodAttr = ProductAttribute::create([
            'product_id' => $product_id,
            'product_attr_name' => '',
        ]);
        $insertOpts = [];
        $name = '';
        foreach ($opts as $opt_id) {

            $insertOpts[] = [
                'product_attribute_id' => $prodAttr->id,
                'attribute_option_id' => $opt_id,
            ];
            $attrOption = AttributeOption::find($opt_id);
            $name .= $attrOption->name . ' - ';
        }
        ProductDetail::insert($insertOpts);
        $name = substr($name, 0, -2);
        $prodAttr->product_attr_name = $name;
        $prodAttr->save();
        return $prodAttr;

    }

    public static function existsVariation($data, $product_id) {
        $product = Product::with('variations.details')->find($product_id);
        $variations = $product->variations->toArray();
        sort($data);
        foreach ($variations as $key => $item) {
            $opts = [];
            foreach ($item['details'] as $key => $value) {
                $opts[] = $value['attribute_option_id'];
            }
            sort($opts);
            if ($data == $opts) {
                return true;
            }
        }
        return false;
    }

    public static function resetVariations($product_id){
        $variations = ProductAttribute::where('product_id', $product_id)->with('details');
        foreach ($variations->get() as $key => $value) {
          // dd($value);
            $value->details()->delete();
        }
        $variations->delete();
    }

    public static function createFamily($attributes, $product_id){
        $name_family = '';
        $ids_attr_family = [];
        foreach ($attributes as $key => $attr) {
            $ids_attr_family[] = $attr->id;
            $name_family .= $attr->name . ' - ';
        }
        $name_family = substr($name_family, 0, -2);
        $family = Family::where('name', $name_family)->first();
        if (!$family) {
            $object = Family::create(['name' => $name_family]);
            foreach ($attributes as  $attr) {
               $array_attr[] = $attr->id;
            }
            $object->group()->sync($array_attr);
            Product::where('id', $product_id)->update(['family_id'=> $object->id]);
        }else{
            Product::where('id', $product_id)->update(['family_id'=> $family->id]);
        }
    }

    public static function resetDetailsWithAttributes($attribute_id){
        $options = AttributeOption::where('attribute_id', $attribute_id)->with('details');
        foreach ($options->get() as $key => $option) {
           foreach ($option->details as  $detail) {
              $detail->product_attribute()->delete();
           }
            $option->details()->delete();
        }
        $options->delete();
    }

    public static function resetDetailsWithOptions($option){
        $option = AttributeOption::where('id', $option)->with('details')->first();
        foreach ($option->details as  $detail) {
          $detail->product_attribute()->delete();
        }
        $option->details()->delete();
        $option->delete();
    }
}