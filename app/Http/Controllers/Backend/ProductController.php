<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\Brand;
use App\Models\ProductImages;
use App\Models\NewArrivalHotSale;
use Carbon\Carbon;
use DB;
class ProductController extends Controller
{
    public function productImages($path)
    {
        $storagePath = storage_path('/images/product/'.$path);
        return response()->file($storagePath);
    }

    public function productDetails($path)
    {
        $storagePath = storage_path('/images/product/details/'.$path);
        return response()->file($storagePath);
    }

    public function index(Request $request){

        $keyword = $request->input('keyword');

        $products = Products::selectRaw(
            'products.id,
            products.product_name,
            products.thumbnail,
            products.created_by,
            products.updated_by,
            products.details,
            product_types.type_name as pro_type_name,
            brand_name.name as brand_name,
            product_types.id as pro_type_id
            '
        )
        ->join('brand_name','brand_name.id','=','products.brand_name_id')
        ->join('product_types','product_types.id','=','brand_name.pro_type_id');

        if($keyword != ""){
            $products->where('products.product_name','like', '%'.$keyword.'%');
        }

        // Product Count
        $Product_all = $products->get();
        $countProduct = $Product_all->count();

        // Paginate
        $products = $products->paginate(10);

        $getProductSales = NewArrivalHotSale::get();

        return view('backend.Products.index',['products'=>$products,'getProductSales'=>$getProductSales,'countProduct'=>$countProduct]);
    }

    // New Arrival
    public function productNewArrival(){
        $getNewArrivals = NewArrivalHotSale::selectRaw(
            'new_arrival_hot_sales.id,
            new_arrival_hot_sales.type,
            products.product_name,
            products.thumbnail,
            products.created_by,
            products.updated_by,
            products.details,
            product_types.type_name as pro_type_name,
            brand_name.name as brand_name,
            product_types.id as pro_type_id
            '
        )
        ->join('products','products.id','=','new_arrival_hot_sales.product_id')
        ->join('brand_name','brand_name.id','=','products.brand_name_id')
        ->join('product_types','product_types.id','=','brand_name.pro_type_id')
        ->where('new_arrival_hot_sales.type', 'newArrival')
        ->get();
        return view('backend.Products.New-Arrivals.index',['getNewArrivals' => $getNewArrivals]);
    }

    public function destroyNewArrival($id){
        $ID = decrypt($id);
        $getNewArrivals = NewArrivalHotSale::where('id', $ID)->firstorfail()->delete();
        return redirect()->back()->with('delete','New Arrivals is Deleted Successfully!');
    }

    // Hot Sale
    public function productHotSale(){
        $getHotSales = NewArrivalHotSale::selectRaw(
            'new_arrival_hot_sales.id,
            new_arrival_hot_sales.type,
            products.product_name,
            products.thumbnail,
            products.created_by,
            products.updated_by,
            products.details,
            product_types.type_name as pro_type_name,
            brand_name.name as brand_name,
            product_types.id as pro_type_id
            '
        )
        ->join('products','products.id','=','new_arrival_hot_sales.product_id')
        ->join('brand_name','brand_name.id','=','products.brand_name_id')
        ->join('product_types','product_types.id','=','brand_name.pro_type_id')
        ->where('new_arrival_hot_sales.type', 'hotSale')
        ->get();
        return view('backend.Products.Hot-Sales.index',['getHotSales' => $getHotSales]);
    }

    public function destroyHotSale($id){
        $ID = decrypt($id);
        $hotSales = NewArrivalHotSale::where('id', $ID)->firstorfail()->delete();
        return redirect()->back()->with('delete','Hot Sales is Deleted Successfully!');
    }

    public function addProduct(){
        $productTypes = ProductType::get();
        $brands = Brand::get();
        return view('backend.Products.add-product',['productTypes'=>$productTypes]);
    }
    public function create(Request $req){

        $req->validate([
            'pro_type_id' => 'required',
            'brand_id' => 'required',
            'product_name' => 'required',
            'original_price' => 'required',
            'product_image' => 'required',
            'detail_editer' => 'required',
        ]);
        $dateTime = Carbon::now();

        $product = new Products();
        $product->brand_name_id = $req->brand_id;
        $product->product_name = $req->product_name;
        $product->original_price = $req->original_price;
        $product->price_after_discount = $req->price_after_discount;
        $product->details = $req->detail_editer;
        $product->status = '1';
        $product->created_by = auth('user')->user()->full_name;

        $file = $req->file('product_image');
        if(!empty($file)){
            $name = md5($file->getFilename() . $dateTime) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/images/product/';
            $file->move(storage_path($file_dir), $name);
            $product->thumbnail = $name;
        }
        $product->save();

        if($files = $req->file('product_images')){
            foreach($files as $file){
                $name = "detail-".md5($file->getFilename() . $dateTime) . '.' . $file->getClientOriginalExtension();
                $file_dir  = '/images/product/details';
                $file->move(storage_path($file_dir), $name);

                $imageDetail = new ProductImages();
                $imageDetail->product_id = $product->id;
                $imageDetail->image_name = $name;
                $imageDetail->save();
            }
        }

        if($req->isHotSale == "1"){
            // save to hot sale
            $hotSales = new NewArrivalHotSale;
            $hotSales->product_id = $product->id;
            $hotSales->type = "hotSale";
            $hotSales->save();
        }

        if($req->isNewArrival == "1"){
            // save to hot sale
            $newArrival = new NewArrivalHotSale;
            $newArrival->product_id = $product->id;
            $newArrival->type = "newArrival";
            $newArrival->save();
        }

        return redirect('view-product')->with('success','Product added Successfully!');
    }

    public function getBrands(Request $req){
        $brands = Brand::where('pro_type_id', $req->id)->get();
        return json_encode($brands);
    }

    public function upload(Request $request)
    {
        // if($request->hasFile('upload')) {
        //     $originName = $request->file('upload')->getClientOriginalName();
        //     $fileName = pathinfo($originName, PATHINFO_FILENAME);
        //     $extension = $request->file('upload')->getClientOriginalExtension();
        //     $fileName = $fileName.'_'.time().'.'.$extension;

        //     $request->file('upload')->move(public_path('images'), $fileName);

        //     $CKEditorFuncNum = $request->input('CKEditorFuncNum');
        //     $url = asset('images/'.$fileName); 
        //     $msg = 'Image successfully uploaded'; 
        //     $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                
        //     @header('Content-type: text/html; charset=utf-8'); 
        //     echo $response;
        // }

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
      
            $request->file('upload')->move(public_path('images'), $fileName);
      
            $url = asset('images/' . $fileName);
  
            return response()->json(['fileName' => $fileName, 'uploaded'=> 1, 'url' => $url]);
        }
    }

    public function editProduct($id){
        $ID = decrypt($id);
       
        $productTypes = ProductType::get();
        $editProduct = Products::selectRaw(
            'products.id,
            products.brand_name_id,
            products.product_name,
            products.thumbnail,
            products.original_price,
            products.price_after_discount,
            products.created_by,
            products.updated_by,
            products.details,
            product_types.type_name as pro_type_name,
            brand_name.name as brand_name,
            product_types.id as pro_type_id
            '
        )
        ->join('brand_name','brand_name.id','=','products.brand_name_id')
        ->join('product_types','product_types.id','=','brand_name.pro_type_id')
        ->where('products.id', $ID)
        ->first();

        $isNewArrival = NewArrivalHotSale::where('product_id', $ID)
        ->where('type', 'newArrival')
        ->exists();

        $isHotSale = NewArrivalHotSale::where('product_id', $ID)
        ->where('type', 'hotSale')
        ->exists();

        $productDetail = ProductImages::where('product_id', $ID)->get();
        return view('backend.Products.edit-product', ['editProduct'=>$editProduct, 'productTypes'=>$productTypes, 'productDetail'=>$productDetail, 'isHotSale'=>$isHotSale, 'isNewArrival'=>$isNewArrival]);
    }

    public function deleteImageDetail($id){
        $ID = decrypt($id);
        $productDetail = ProductImages::where('id', $ID)->firstorfail()->delete();
        return redirect()->back()->with('delete','ImageDetails Deleted Successfully!');
    }

    public function updateProduct(Request $request, $id){

        $ID = decrypt($id);
        $dateTime = Carbon::now();
        $product = Products::where('id', $ID)->firstorfail();
        $product->brand_name_id = $request->brand_id;
        $product->product_name = $request->product_name;
        $product->original_price = $request->original_price;
        $product->price_after_discount = $request->price_after_discount;
        $product->details = $request->detail_editer;
        $product->updated_by = auth('user')->user()->full_name;

        $file = $request->file('product_image');
        if(!empty($file)){
            $name = md5($file->getFilename() . $dateTime) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/images/product/';
            $file->move(storage_path($file_dir), $name);
            $product->thumbnail = $name;
        }
        $product->update();

        if($files = $request->file('product_images')){
            foreach($files as $file){
                $name = "detail-".md5($file->getFilename() . $dateTime) . '.' . $file->getClientOriginalExtension();
                $file_dir  = '/images/product/details';
                $file->move(storage_path($file_dir), $name);
                
                $imageDetail = new ProductImages();
                $imageDetail->product_id = $product->id;
                $imageDetail->image_name = $name;
                $imageDetail->save();
            }
        }

        $hotSales = NewArrivalHotSale::where("product_id", $ID)->where('type', 'hotSale')->first();

        if(!empty($hotSales) && $request->isHotSale == null){
            $hotSales->delete();
        }else if(empty($hotSales) && $request->isHotSale == "1"){
            $hotSale = new NewArrivalHotSale;
            $hotSale->product_id =  $ID;
            $hotSale->type = "hotSale";
            $hotSale->save();
        }

        $newArrival_ = NewArrivalHotSale::where("product_id", $ID)->where('type', 'newArrival')->first();

        if(!empty($newArrival_) && $request->isNewArrival == null){
            $newArrival_->delete();
        }else if(empty($newArrival_) && $request->isNewArrival == "1"){
            $newArrival = new NewArrivalHotSale;
            $newArrival->product_id =  $ID;
            $newArrival->type = "newArrival";
            $newArrival->save();
        }

        return redirect()->to($request->last_url)->with('update','Product Updated Successfully!');
    }

    public function destroyProduct($id){
        $ID = decrypt($id);
        $products = Products::findorFail($ID);
        $products->delete();
        $getProductImages = ProductImages::where('product_id', $ID)->delete();
        return redirect()->back()->with('success','Product and ProductImage is Deleted Successfully!');
    }

}
