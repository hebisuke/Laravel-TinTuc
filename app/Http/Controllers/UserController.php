<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem(){
        return view('admin.user.them');
    }

    public function postThem(Request $request){
        $this->validate($request,[
            'email' => 'unique:users,email'
        ],[
            'email.unique' => 'Email đã tồn tại'
        ]);
        
        $user = new User;
        $user->name = $request->tenUser;
        $user->email = $request->email;
        $user->password = bcrypt($request->passWord) ;
        $user->quyen = $request->quyen;

        $user->save();
        return redirect('admin/user/them')->with('thongbao','Thêm thành công');
    }

    public function getSua($id){
        $user = User::find($id);

        return view('admin.user.sua',['user'=> $user]);

    }

    public function postSua(Request $request,$id){
        $this->validate($request,[
           //
        ],[
           //
        ]);
        
        $user =  User::find($id);
        $user->name = $request->tenUser;
        $user->quyen = $request->quyen;
        if ($request->changePassword == "on"){
            $user->password = bcrypt($request->passWord) ;
        }
       

       $user->save();
       return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getXoa($id){
        $user = User::find($id);

        $user->delete();

        return redirect('admin/user/danhsach')->with('thongbao','Xóa thành công');
    }

    public function getDangNhapAdmin(){
       
        return view('admin.login');
    }

    public function postDangNhapAdmin(Request $request){
        $this->validate($request,[

        ],[

        ]);

        if(Auth::attempt(['email'=>$request,'password'=>$request->password])){
            // if(Auth::user()->quyen == 0){
            //     Auth::logout();
            //     return redirect('admin/dangnhap')->with('Không đủ quyền truy cập');
            // }
            return redirect('admin/theloai/danhsach')->with('thongbao','Chào mừng đến với trang quản lý');
        }else{
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }

    public function getDangXuat(){
        Auth::logout();
        return redirect('admin/dangnhap');
    }
}
