<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    //
    public function getDanhSach(){
        $slide = Slide::all();

        return view('admin.slide.danhsach',['slide'=>$slide]);

    }
    public function getThem(){
        return view('admin.slide.them');
    }

    public function postThem(Request $request){

        // $this->validate($reques,[

        // ],[

        // ]);
        $slide = new Slide;
        $slide->Ten = $request->tenSlide;
        $slide->NoiDung = $request->noiDung;

        $link_array = explode('/',$request->url);
        $tenHinh= end($link_array);

        if (preg_match('/(\.jpg|\.png|\.jpeg|\.gif)$/', $tenHinh)) {

            $slide->Hinh = $tenHinh;
            $slide->linkIMG = $request->url;
            
        }else{
            $slide->Hinh = "";
            $slide->linkIMG = "";
        }

        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm slide thành công');
    }

    public function getSua($id){
        $slide = Slide::find($id);

        return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function postSua(Request $request,$id){
        $slide = Slide::find($id);
        $slide->Ten = $request->tenSlide;
        $slide->NoiDung = $request->noiDung;

        $link_array = explode('/',$request->url);
        $tenHinh= end($link_array);

        if (preg_match('/(\.jpg|\.png|\.jpeg|\.gif)$/', $tenHinh)) {

            $slide->Hinh = $tenHinh;
            $slide->linkIMG = $request->url;
            
        }else{
            $slide->Hinh = "";
            $slide->linkIMG = "";
        }

        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao','Sửa slide thành công');
    }

    public function getXoa($id){
        $slide = Slide::find($id);
        $slide->delete();

        return redirect('admin/slide/danhsach')->with('thongbao','Xóa thành công');

    }
}
