<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\Comment;
use App\User;

class PageController extends Controller
{
    //
    
   
    function __construct(){
        $theloai = TheLoai::all();
        // $slide = Slide::orderBy('id','DESC')->take(4);
        $slide = DB::table('slide')->orderBy('id','DESC')->take(4)->get();
        view()->share(['theloai'=> $theloai,'slide'=> $slide]);
    }
    function getTrangChu(){
        return view('pages.trangchu');
    }

    function getLienLac(){
        return view('pages.lienlac');
    }

    function getLoaiTin($id){
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin','=',$id)->paginate(5);
        return view('pages.loaitin',['loaitin'=>$loaitin, 'tintuc' =>$tintuc]);
    }

    public function getTinTuc($id){
        $tintuc = TinTuc::find($id);
        $tinNoiBat = TinTuc::where('NoiBat','=',1)->inRandomOrder()->take(4)->get();
        $tinLienQuan = TinTuc::where('idLoaiTin','=', $tintuc->idLoaiTin)->inRandomOrder()->take(4)->get();
        $comment = Comment::where('idTinTuc','=',$id)->orderBy('id','desc')->get();
        
        DB::table('tintuc')->where('id', $id)->update(['SoLuotXem' => $tintuc->SoLuotXem+1]);
        
        return view('pages.tintuc',['tintuc'=>$tintuc,'tinNoiBat'=>$tinNoiBat,'tinLienQuan'=>$tinLienQuan,'comment'=>$comment]);
    }

    public function getDangNhap(){
        return view('pages.dangnhap');
    }

    public function postDangNhap(Request $request){
        $this->validate($request,[

        ],[

        ]);

        if(Auth::attempt(['email'=>$request,'password'=>$request->password])){
            // if(Auth::user()->quyen == 0){
            //     Auth::logout();
            //     return redirect('admin/dangnhap')->with('Không đủ quyền truy cập');
            // }
            return redirect('trangchu')->with('thongbao','Chào mừng đến với trang quản lý');
        }else{
            return redirect('dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
    }

    public function getDangXuat(){
        Auth::logout();
        return redirect('trangchu');
    }

    public function postBinhLuan(Request $request,$id){
        $tintuc = TinTuc::find($id);
        $comment = new Comment;
        $comment->idTinTuc = $id;
        $comment->idUser = Auth::user()->id;
        $comment->NoiDung = $request->NoiDung;
        
        $comment->save();
        return redirect("tintuc/".$id."/".$tintuc->TieuDeKhongDau.".html")->with('thongbao','Viết bình luận thành công');
    }

    public function getSuaNguoiDung($id){
        $user = User::find($id);

        return view('pages.nguoidung',['user'=> $user]);
    }

    public function postSuaNguoiDung(Request $request,$id){
        $this->validate($request,[
           //
        ],[
           //
        ]);
        
        $user =  User::find($id);
        $user->name = $request->tenUser;
        if ($request->changePassword == "on"){
            $user->password = bcrypt($request->passWord) ;
        }
       

       $user->save();
       return redirect('nguoidung/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    public function getDangKy(){
        return view('pages.dangky');
    }

    public function postDangKy(Request $request){
        $this->validate($request,[
            'email' => 'unique:users,email'
        ],[
            'email.unique' => 'Email đã tồn tại'
        ]);
        
        $user = new User;
        $user->name = $request->tenUser;
        $user->email = $request->email;
        $user->password = bcrypt($request->passWord) ;
        $user->quyen = 0;

        $user->save();
        return redirect('dangnhap')->with('thongbao2','Đăng ký thành công');
    }

    public function getTimKiem(Request $request){
        $tukhoa = $request->tuKhoa;
        $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orWhere('TomTat','like',"%$tukhoa%")->orWhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);

        return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }

    public function getGioiThieu(){
        return view('pages.gioithieu');
    }
}
