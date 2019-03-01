<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    //
    public function getDanhSach(){
        $loaitin = LoaiTin::All();
        return view('admin.loaitin.danhsach',['loaitin'=>$loaitin]);
    }
    
    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['theloai'=> $theloai]);
    }

    public function postThem(Request $request){
        $this->validate( $request,[
            'tenLoaiTin' => 'required|max:100|min:3',
            'idTheLoai' =>'required'
        ],[
            'tenLoaiTin.required'=> 'Bạn chưa nhập tên Loai Tin',
            'tenLoaiTin.max' => 'Chỉ được nhập từ 3 đến 100 ký tự',
            'tenLoaiTin.min' => 'Chỉ được nhập từ 3 đến 100 ký tự' ,
            'idTheLoai' => 'Bạn chưa chọn Thể Loại'
        ]);


        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->tenLoaiTin;
        $loaitin->idTheLoai = $request->idTheLoai;
        $loaitin->TenKhongDau = changeTitle($request->tenLoaiTin);

        $loaitin->Save();

        return redirect('admin/loaitin/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
        $loaitin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin.loaitin.sua',['loaitin'=>$loaitin,'theloai'=>$theloai]);
    }

    public function postSua(Request $request,$id){
        $this ->validate($request,[
            'tenLoaiTin' => 'required|min:3|max:100',
            'idTheLoai' =>'required'
        ],[
            'tenLoaiTin.require' => 'Bạn chưa nhập Tên Loại Tin',
            'tenLoaiTin.max' => 'Chỉ nhập từ 3 đến 100 ký tự',
            'tenLoaiTin.min' => 'Chỉ nhập từ 3 đến 100 ký tự',
            'idTheLoai' => 'Bạn chưa chọn Thể Loại'
        ]);


        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->tenLoaiTin;
        $loaitin->TenKhongDau = changeTitle($request->tenLoaiTin);
        $loaitin->idTheLoai = $request->idTheLoai;

        $loaitin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $loaitin = LoaiTin::find($id);
        $loaitin->delete();

        return redirect('admin/loaitin/danhsach')->with('thongbao','Xóa thành công');
    }
}
