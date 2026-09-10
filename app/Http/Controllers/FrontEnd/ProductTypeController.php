<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\Brand;

class ProductTypeController extends Controller
{
    public function index($id){
        $ID = decrypt($id);
        session()->put('activeMenuId', $id);
        $productTypes = ProductType::where('id', $ID)->first();
        $brands = Brand::where('pro_type_id', $productTypes->id)->get();

        $getProduct = Products::selectRaw(
            'products.id,
            products.product_name,
            products.thumbnail,
            products.original_price,
            products.price_after_discount,
            brand_name.name as brand_name,
            product_types.type_name as pro_type_id
            '
        )
        ->join('brand_name','brand_name.id','=','products.brand_name_id')
        ->join('product_types','product_types.id','=','brand_name.pro_type_id')
        ->where('pro_type_id', $ID)
        ->paginate(16);

        return view('frontend.product-type',['productTypes'=>$productTypes,'brands'=>$brands,'getProduct'=>$getProduct]);
    }

    public function getBrand($id){
        $ID = decrypt($id);
        $getBrands = Brand::selectRaw(
            'brand_name.id,
            brand_name.name,
            product_types.type_name as pro_type_id
            '
        )
        ->join('product_types','product_types.id', '=', 'brand_name.pro_type_id')
        ->where('brand_name.id', $ID)->first();

        $getProduct = Products::where('brand_name_id', $ID)->get();

        $brands = Brand::selectRaw(
            'brand_name.id,
            brand_name.name,
            product_types.id as product_type_id
            '
        )
        ->join('product_types','product_types.id', '=', 'brand_name.pro_type_id')
        ->get();

        return view('frontend.product-type-detail',['getBrands'=>$getBrands, 'brands'=>$brands]);
    }
}
