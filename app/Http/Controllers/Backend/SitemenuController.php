<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteMenu;

class SitemenuController extends Controller
{
    // SiteProduct
    public function index(){
        $siteMenus = SiteMenu::where('isActiveMenu','0')
        ->get();
        return view('backend.SiteMenus.index',['siteMenus'=>$siteMenus]);
    }

    public function siteProduct(){
        $siteProducts = SiteMenu::where('isActiveMenu','1')
        ->get();
        
        return view('backend.SiteProducts.index',['siteProducts' => $siteProducts]);
    }

    public function createMenu(){
        return view('backend.SiteMenus.add-sitemenu');
    }

    public function createSiteProduct(){
        return view('backend.SiteProducts.add-siteproduct');
    }

    public function addSitemenu(Request $request){

        $request->validate([
            'name' => 'required',
        ]);
        $siteMenus = New SiteMenu();
        $siteMenus->name = $request->name;
        $siteMenus->created_by = auth('user')->user()->full_name;
        $siteMenus->isActiveMenu = 0;
        $siteMenus->status = 1;
        $siteMenus->detail = $request->detail_editer;

        // $file = $request->file('icon_photo');
        // if(!empty($file)){
        //     $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
        //     $file_dir  = '/icons/';
        //     $file->move(storage_path($file_dir), $name);
        //     $siteMenus->icon = $name;
        // }

        $siteMenus->save();
        return redirect('site-menus')->with('success','Sitemenus added Successfully!');
    }

    public function uploadSitemenu(Request $request)
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

    public function addSitemenuProduct(Request $request){

        $request->validate([
            'name' => 'required',
            'icon_photo' => 'required'
        ]);
        $siteProducts = New SiteMenu();
        $siteProducts->name = $request->name;
        $siteProducts->created_by = auth('user')->user()->full_name;
        $siteProducts->isActiveMenu = 1;
        $siteProducts->status = 1;

        $file = $request->file('icon_photo');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/icons/';
            $file->move(storage_path($file_dir), $name);
            $siteProducts->icon = $name;
        }
        $siteProducts->save();
        return redirect('site-products')->with('success','Sitemenus added Successfully!');
    }

    public function editSitemenu($id){
        $ID = decrypt($id);
        $siteMenus = SiteMenu::where('id',$ID)->first();
        return view('backend.SiteMenus.edit-sitemenu',['siteMenus'=>$siteMenus]);
    }

    public function editSiteProduct($id){
        $ID = decrypt($id);
        $siteMenuProducts = SiteMenu::where('id',$ID)->first();
        return view('backend.SiteProducts.edit-siteproduct',['siteMenuProducts'=>$siteMenuProducts]);
    }

    public function updateSitemenu(Request $request, $id){
        $ID = decrypt($id);
        $siteMenus = SiteMenu::where('id', $ID)->firstorfail();
        $siteMenus->name = $request->name;
        $siteMenus->detail = $request->detail_editer;
        $siteMenus->updated_by = auth('user')->user()->full_name;

        $file = $request->file('icon_photo');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/icons/';
            $file->move(storage_path($file_dir), $name);
            $siteMenus->icon = $name;
        }

        $siteMenus->update();
        return redirect()->back()->with('update','Updated Successully!');
    }

    public function isActive(Request $request){
        $siteMenus = SiteMenu::find($request->id);
        $siteMenus->status = $request->status;
        $siteMenus->save();
        return response()->json(['success'=>'Status change successfully.']);
    }

    public function destroySite($id){
        $ID = decrypt($id);
        $sites = SiteMenu::where('id', $ID)->firstorfail()->delete();
        return redirect()->back()->with('delete','delete is Successully!');
    }

}
