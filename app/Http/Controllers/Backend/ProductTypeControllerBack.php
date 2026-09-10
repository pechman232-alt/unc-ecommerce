<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\SiteMenu;

class ProductTypeControllerBack extends Controller
{
    public function index(Request $request){

        $keyword = $request->input('keyword');

        $product_types = ProductType::selectRaw(
            'product_types.id,
            product_types.type_name,
            product_types.created_by,
            product_types.updated_by,
            product_types.status,
            site_menu.name as sitemenu
            '
        )
        ->join('site_menu','site_menu.id','=','product_types.menu_id')
        ->where('product_types.status','=','1');
        
        if($keyword != ""){
            $product_types->where('product_types.type_name','like', '%'.$keyword.'%')
                        ->orWhere('site_menu.name','like', '%'.$keyword.'%')
                        ->orWhere('product_types.created_by','like', '%'.$keyword.'%')
                        ->orWhere('product_types.updated_by','like', '%'.$keyword.'%');
        }

        // count Data
        $Product_types_all = $product_types->get();
        $countProduct_types = $Product_types_all->count();

        // Paginate
        $product_types = $product_types->paginate(10);

        return view('backend.ProductType.index',['product_types'=>$product_types,'countProduct_types'=>$countProduct_types]);
    }

    public function addProductType(){
        $sitemenus = SiteMenu::get();
        return view('backend.ProductType.add-product-type',['sitemenus'=>$sitemenus]);
    }

    public function createProductType(Request $request){

        $request->validate([
            'type_name' => 'required',
            'menu_id' => 'required'
        ]);
        $product_types = New ProductType();
        $product_types->type_name = $request->type_name;
        $product_types->menu_id = $request->menu_id;
        $product_types->created_by = auth('user')->user()->full_name;
        $product_types->status = 1;

        $product_types->save();
        return redirect('product-type')->with('success','Product Type added Successfully!');
    }

    public function editProductType($id){
        $ID = decrypt($id);
        $product_types = ProductType::where('id',$ID)->first();
        $sitemenus = SiteMenu::get();
        return view('backend.ProductType.edit-product-type',['product_types'=>$product_types,'sitemenus'=>$sitemenus]);
    }

    public function updateProductType(Request $request, $id){

        $ID = decrypt($id);
        $product_types = ProductType::where('id', $ID)->firstorfail();
        $product_types->type_name = $request->type_name;
        $product_types->menu_id = $request->menu_id;
        $product_types->updated_by = auth('user')->user()->full_name;
        $product_types->update();
        
        return redirect()->to($request->last_url)->with('update','ProductType Updated Successully!');
    }

    public function destroyProductType($id){
        $ID = decrypt($id);
        $product_types = ProductType::where('id', $ID)->firstorfail()->delete();
        return redirect('product-type')->with('delete','ProductType Deleted Successully!');
    }

    public function icons($path)
    {
        $storagePath = storage_path('/icons/'.$path);
        return response()->file($storagePath);
    }

}
