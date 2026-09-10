<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\ProductImages;
use App\Models\Brand;

class ProductDetailController extends Controller
{
    public function index($id){

        $ID = decrypt($id);
        $productDetails = Products::where('id', $ID)->first();
        $product_images = ProductImages::where('product_id', $ID)->get();

        $brands = Brand::selectRaw(
            'brand_name.id,
            brand_name.name,
            product_types.type_name
            '
        )
        ->join('product_types','product_types.id','=','brand_name.pro_type_id')
        ->where('brand_name.id', $productDetails->brand_name_id)
        ->first();
        
        $getProductbyBrands = Products::where('brand_name_id', $productDetails->brand_name_id)
        ->where('id', '!=', $ID)
        ->orderBy('id', 'desc')
        ->limit(12)
        ->get();

        return view('frontend.product-detail',['productDetails'=>$productDetails,'product_images'=>$product_images,'brands'=>$brands,'getProductbyBrands'=>$getProductbyBrands]);
    }
}
