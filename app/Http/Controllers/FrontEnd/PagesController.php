<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMenu;
use App\Models\ProductType;
use App\Models\Brand;
use App\Models\Products;

class PagesController extends Controller
{
    public function index($id){
        
        $ID = decrypt($id);
        session()->put('activeMenuId', $id);
        $pages = SiteMenu::where('id', $ID)->where('isActiveMenu','=', '1')->first(); 

        $productTypes = ProductType::where('menu_id', $ID)->get();

        for($i=0; $i < count($productTypes); $i++){
            $productTypes[$i]['brand_names']= Brand::where('pro_type_id', $productTypes[$i]['id'])->get();
        }

        $getProducts = Products::selectRaw(
            'products.id,
            products.product_name,
            products.original_price,
            products.price_after_discount,
            products.details,
            products.thumbnail,
            products.status
            '
        )
        ->join('brand_name','brand_name.id','=','products.brand_name_id')
        ->join('product_types','product_types.id','=','brand_name.pro_type_id')
        ->join('site_menu','site_menu.id','=','product_types.menu_id')
        ->where('site_menu.id', $ID)->paginate(10);

        return view('frontend.pages',['pages'=>$pages, 'productTypes'=>$productTypes,'getProducts'=>$getProducts]);
    }

    public function page($id){
        $ID = decrypt($id);
        $page = SiteMenu::where('id', $ID)->where('isActiveMenu','=', '0')->first(); 
        return view('frontend.page',['page'=>$page]);
    }
    public function productBybrand($id){
        $ID = decrypt($id);

        $brandId= $ID[0];
        $proTypeId= $ID[1];
        $pages = (object)array('name'=>$ID[2]);

        $productTypes = ProductType::where('id', $proTypeId)->get();

        for($i=0; $i < count($productTypes); $i++){
            $productTypes[$i]['brand_names']= Brand::where('pro_type_id', $proTypeId)->get();
        }

        $getProducts = Products::where('brand_name_id', $brandId)
        ->paginate(16);
        
        return view('frontend.pages',['pages'=>$pages, 'productTypes'=>$productTypes,'getProducts'=>$getProducts]);
    }
}
