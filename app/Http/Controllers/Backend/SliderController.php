<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slide;

class SliderController extends Controller
{
    public function index(){

        $sliders = Slide::where('status', '=', '1')
        ->get();
        return view('backend.Slider.index',['sliders'=>$sliders]);

    }

    public function addSlider(){
        return view('backend.Slider.add-slide');
    }

    public function createSlide(Request $request, Slide $slider){

        $request->validate(['image_slider' => 'required']);
        $slider = new Slide();
        $slider->created_by = auth('user')->user()->full_name;
        $slider->status = 1;

        $file = $request->file('image_slider');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/slider/';
            $file->move(storage_path($file_dir), $name);
            $slider->name = $name;
        }
       
        $slider->save();
        return redirect('slider')->with('success','Slide Added Successully!');
    }

    public function editSlide($id){
        $ID = decrypt($id);
        $sliders = Slide::where('id', $ID)->first();
        return view('backend.Slider.edit-slide',['slider'=>$sliders]);
    }

    public function updateSlide(Request $request, $id){

        $ID = decrypt($id);
        $slider = Slide::where('id', $ID)->firstorfail();
        $slider->updated_by = auth('user')->user()->full_name;

        $file = $request->file('image_slider');
        if(!empty($file)){
            $name = md5($file->getFilename() . time()) . '.' . $file->getClientOriginalExtension();
            $file_dir  = '/slider/';
            $file->move(storage_path($file_dir), $name);
            $slider->name = $name;
        }
       
        $slider->update();
        return redirect('slider')->with('update','Slide Updated Successully!');
    }

    public function destroySlide($id){
        $ID = decrypt($id);
        $sliders = Slide::where('id', $ID)->firstorfail()->delete();
        return redirect('slider')->with('delete','Slide Deleted Successully!');
    }

    public function slider($path)
    {
        $storagePath = storage_path('/slider/'.$path);
        return response()->file($storagePath);
    }

    public function statusSlider(Request $request){
        $sliders = Slide::find($request->id);
        $sliders->status = $request->status;
        $sliders->save();
        return response()->json(['success'=>'Status change successfully.']);
    }
}
