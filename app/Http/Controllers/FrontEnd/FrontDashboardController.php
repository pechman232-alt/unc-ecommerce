<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;
use App\Models\Products;
use Illuminate\Support\Facades\Cache;

class FrontDashboardController extends Controller
{
    public function index(){

        $cacheKey = 'key_slider';
        $cacheDuration = 5; // Cache duration in minutes

        $sliders = Cache::remember($cacheKey, $cacheDuration, function() {
            return Slide::where('status', '=', '1')->get();
        });

        return view('frontend.front-dashboard',['sliders'=>$sliders]);

        // $sliders = Slide::where('status', '=', '1')
        // ->get();
        // return view('frontend.front-dashboard',['sliders'=>$sliders]);
    }

    public function search(Request $req){
        $searchVal = $req->searchVal;
        $searchDatas = Products::selectRaw(
            'products.id,
            products.product_name,
            products.price_after_discount,
            products.original_price,
            products.thumbnail
        ')->where('status', '1')
        ->where('product_name', 'like', '%'.$searchVal.'%')
        ->orWhere('price_after_discount', 'like', '%'.$searchVal.'%')
        ->orWhere('original_price', 'like', '%'.$searchVal.'%')
        ->orderBy('id', 'desc')
        ->limit(10)
        ->get();
        foreach ($searchDatas as $searchData) {
            $searchData->id_en = encrypt($searchData->id);
        }
      
        return response()->json($searchDatas);
    }

    public function aboutUs(){
        return view('frontend.about-us');
    }

    public function contactUs(){
        return view('frontend.contact-us');
    }
}
