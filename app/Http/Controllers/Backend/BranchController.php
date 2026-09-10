<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductType;
use App\Models\Brand;

class BranchController extends Controller
{
    public function index(){
        $brands = Brand::selectRaw(
            'brand_name.id,
            brand_name.name,
            brand_name.status,
            product_types.type_name as pro_type_name,
            brand_name.created_by,
            brand_name.updated_by
            '
        )
        ->join('product_types','product_types.id','=','brand_name.pro_type_id')
        ->get();
        return view('backend.Brands.index',['brands'=>$brands]);
    }

    public function addBrand(){
        $product_types = ProductType::get();
        return view('backend.Brands.add-brand',['product_types'=>$product_types]);
    }

    public function createBrand(Request $request){
        $request->validate([
            'name' => 'required',
            'pro_type_id' => 'required'
        ]);
        $brands = new Brand();
        $brands->name = $request->name;
        $brands->pro_type_id = $request->pro_type_id;
        $brands->created_by = auth('user')->user()->full_name;
        $brands->status = 1;
        $brands->save();
        return redirect('brand')->with('success','Brand added Successfully!');
    }

    public function editBrand($id){
        $ID = decrypt($id);
        $brands = Brand::where('id',$ID)->first();
        $product_types = ProductType::get();
        return view('backend.Brands.edit-brand',['product_types'=>$product_types,'brands'=>$brands]);
    }

    public function updateBrand(Request $request, $id){
        $ID = decrypt($id);
        $brands = Brand::where('id', $ID)->firstorfail();
        $brands->name = $request->name;
        $brands->pro_type_id = $request->pro_type_id;
        $brands->updated_by = auth('user')->user()->full_name;
        $brands->save();
        return redirect('brand')->with('update','Brand Updated Successfully!');
    }

    public function destroyBrand($id){
        $ID = decrypt($id);
        $brands = Brand::where('id', $ID)->firstorfail()->delete();
        return redirect('brand')->with('delete','Brand Deleted Successfully!');
    }

}
