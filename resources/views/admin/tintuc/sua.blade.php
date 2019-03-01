@extends('admin.layout.index')

@section('content')
    
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Sửa</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                     <div class="alert alert-danger">
                         @foreach ($errors->all() as $err)
                                {{$err}}<br>
                        @endforeach
                        
                     </div> 
                @endif

                @if(session('thongbao'))
                     <div class = "alert alert-success">
                            {{session('thongbao')}}
                    </div>
                @endif
                <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <label>Thể Loại</label>
                        <select class="form-control" id="theloai" name="idTheLoai">
                            @foreach ($theloai as $tl)
                                <option 
                                @if($tintuc->loaitin->theloai->id == $tl->id)
                                           {{"selected"}}                
                                @endif
                                value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group" >
                        <label>Loại Tin</label>
                        <select class="form-control" id="loaitin" name="idLoaiTin">
                            
                                @foreach ($loaitin as $lt)
                                    @if($tintuc->loaitin->theloai->id == $lt->idTheLoai)
                                        <option value="{{$lt->id}}">{{$lt->Ten}}</option>                             
                                    @endif
                                @endforeach
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Tiêu Đề</label>
                    <input class="form-control" name="tieuDe" placeholder="Nhập tiêu đề..."  value="{{$tintuc->TieuDe}}"/>
                    </div>
                   
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                    <textarea  id="editor1" class="form-control ckeditor" rows="3" name="tomTat" >{{$tintuc->TomTat}}</textarea>
                    </div>

                    <div class="form-group">
                            <label>Nội Dung</label>
                    <textarea  id="editor2" class="form-control ckeditor" rows="3" name="noiDung">{{$tintuc->NoiDung}}</textarea>
                        </div>

                    <div class="form-group">
                        <input onclick="openPopup()" type="button" value="Chọn hình">
                    <input type="text" size="48" name="url" id="url" placeholder="Chọn Hình" value="/ckfinder/userfiles/images/{{$tintuc->Hinh}}" />
                    <img src="/ckfinder/userfiles/images/{{$tintuc->Hinh}}" alt="" width="400px" id="img">
                    </div>
                    <div class="form-group">
                            <label>Tin Nổi Bật</label>
                            <label class="radio-inline">
                                <input name="noiBat" value="0" 
                                @if ($tintuc->NoiBat == 0)
                                    {{"checked"}}
                                @endif
                                type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="noiBat" value="1" 
                                @if ($tintuc->NoiBat == 1)
                                    {{"checked"}}
                                @endif
                                type="radio">Có
                            </label>
                        </div>
                    <button type="submit" class="btn btn-default">Sửa Tin</button>
                    <input type="button" class="btn btn-default" onClick="window.location.href=window.location.href" value="Tạo lại"> 
                <form>
            </div>
        </div>
        <!-- /.row -->
    <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bình luận
                    <small>danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người Dùng</th>
                        <th>Nội Dung</th>
                        <th>Ngày Đăng</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tintuc->comment as $cm)
                    <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{$cm->user->name}}</td>
                            <td>{{$cm->NoiDung}}</td>
                            <td>{{$cm->created_at}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/xoa/{{$tintuc->id}}/{{$cm->id}}"> Delete</a></td>
                        </tr>
                    @endforeach
                    
                    
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>





@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#theloai').change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai,function(data){
                    $('#loaitin').html(data);
                })
            })
        }); 
    </script>
    
@endsection