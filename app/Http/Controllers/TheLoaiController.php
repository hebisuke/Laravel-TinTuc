<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    //
    public function getDanhSach(){
        $theloai = Theloai::All();
        return view('admin.theloai.danhsach',['theloai'=> $theloai]);
    }

    public function getThem(){
        return view('admin.theloai.them');
    }

    public function postThem(Request $request){
        $this->validate($request,[
            'tenTheLoai' => 'required|min:3|max:100',
        ],[
            'tenTheLoai.required' => 'Bạn chưa nhâp tên Thể Loại',
            'tenTheLoai.min' => 'Thể Loại phải có độ dài từ 3 đến 100 ký tự 100',
            'tenTheLoai.max' => 'Thể Loại phải có độ dài từ 3 đến 100 ký tự 100' ,
        ]);

        $theloai = new TheLoai;
        $theloai->Ten = $request ->tenTheLoai;
        $theloai->TenKhongDau = changeTitle($request->tenTheLoai) ;
        $theloai->save();

        return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=> $theloai]);
    }
    public function postSua(Request $request, $id){
        $this->validate($request,[
            'tenTheLoai' => 'required|min:3|max:100',
        ],[
            'tenTheLoai.required' => 'Bạn chưa nhâp tên Thể Loại',
            'tenTheLoai.min' => 'Thể Loại phải có độ dài từ 3 đến 100 ký tự 100',
            'tenTheLoai.max' => 'Thể Loại phải có độ dài từ 3 đến 100 ký tự 100' ,
        ]);

        $theloai = TheLoai::find($id);
        $theloai->Ten = $request->tenTheLoai;
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao','Đã xóa thành công');

    }
}
