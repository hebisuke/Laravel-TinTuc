<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;

class TinTucController extends Controller
{
    //
    public function getDanhSach(){
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach',['tintuc'=> $tintuc]);
    }
    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();

        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }

    public function postThem(Request $request){
        $this->validate($request,[
            'idLoaiTin'=>'required',
            'tieuDe' => 'required|min:3|unique:TinTuc,TieuDe',
            'tomTat' => 'required',
            'noiDung' => 'required',
            'url' => 'required'
        ],[
            'idLoaiTin.required'=> 'Bạn chưa chọn loại tin',
            'tieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'tieuDe.min' => 'Tiêu đề phải lớn hơn 3 kí tự',
            'tieuDe.unique' =>'Tiêu đề bị trùng',
            'tomTat.required' => 'Bạn chưa nhập tóm tắt',
            'noiDung.required' => 'Bạn chưa nhập nội dung',
            'url.required' => 'Bạn chưa chọn hình ảnh'

        ]);
        
        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->tieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->tieuDe);
        $tintuc->idLoaiTin = $request->idLoaiTin;
        $tintuc->TomTat = $request->tomTat;
        $tintuc->NoiDung = $request->noiDung;
        $tintuc->NoiBat = $request->noiBat;
        $tintuc->soLuotXem = 0;
        
        $link_array = explode('/',$request->url);
        $tenHinh= end($link_array);

        if (preg_match('/(\.jpg|\.png|\.jpeg|\.gif)$/', $tenHinh)) {

            $tintuc->Hinh = $tenHinh;
            
        }else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Thêm tin thành công');
        
    }

    public function getSua($id){

        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();

        return view('admin.tintuc.sua',['tintuc'=>$tintuc,'theloai'=>$theloai,'loaitin'=>$loaitin]);

    }

    public function postSua(Request $request,$id){
        $tintuc = TinTuc::find($id);
        
        $this->validate($request,[
            'idLoaiTin'=>'required',
            'tieuDe' => 'required|min:3',
            'tomTat' => 'required',
            'noiDung' => 'required',
            'url' => 'required'
        ],[
            'idLoaiTin.required'=> 'Bạn chưa chọn loại tin',
            'tieuDe.required' => 'Bạn chưa nhập tiêu đề',
            'tieuDe.min' => 'Tiêu đề phải lớn hơn 3 kí tự',
            
            'tomTat.required' => 'Bạn chưa nhập tóm tắt',
            'noiDung.required' => 'Bạn chưa nhập nội dung',
            'url.required' => 'Bạn chưa chọn hình ảnh'

        ]);
        
        if($tintuc->TieuDe != $request->tieuDe){
            $this->validate($request,[
                'tieuDe' => 'unique:TinTuc,TieuDe'
            ],[
                'tieuDe.unique' =>'Tiêu đề bị trùng'
            ]);
            $tintuc->TieuDe = $request->tieuDe;
        }
        
        $tintuc->TieuDeKhongDau = changeTitle($request->tieuDe);
        $tintuc->idLoaiTin = $request->idLoaiTin;
        $tintuc->TomTat = $request->tomTat;
        $tintuc->NoiDung = $request->noiDung;
        // $tintuc->soLuotXem = 0;
        $tintuc->NoiBat = $request->noiBat;
        
        $link_array = explode('/',$request->url);
        $tenHinh= end($link_array);

        if (preg_match('/(\.jpg|\.png|\.jpeg|\.gif)$/', $tenHinh)) {

            $tintuc->Hinh = $tenHinh;
            
        }else{
            $tintuc->Hinh = "";
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa tin thành công');
    }

    public function getXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Xóa thành công');

    }
}
