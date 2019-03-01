@extends('admin.layout.index')

@section('content')
    
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin Tức
                    <small>Thêm</small>
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
                <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group" >
                        <label>Thể Loại</label>
                        <select class="form-control" id="theloai" name="idTheLoai">
                            @foreach ($theloai as $tl)
                                <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                            @endforeach
                            
                        </select>
                    </div>
                    <div class="form-group" >
                        <label>Loại Tin</label>
                        <select class="form-control" id="loaitin" name="idLoaiTin">
                            <option value="" disabled selected>Vui lòng chọn Thể Loại</option>
                                {{-- @foreach ($loaitin as $lt)
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endforeach --}}
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="tieuDe" placeholder="Nhập tiêu đề..." />
                    </div>
                   
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea  id="editor1" class="form-control ckeditor" rows="3" name="tomTat" ></textarea>
                    </div>

                    <div class="form-group">
                            <label>Nội Dung</label>
                            <textarea  id="editor2" class="form-control ckeditor" rows="3" name="noiDung"></textarea>
                        </div>

                    <div class="form-group">
                        <input onclick="openPopup()" type="button" value="Chọn hình">
                        <input type="text" size="48" name="url" id="url" placeholder="Chọn Hình" />
                        <img src="" alt="" width="450px" id="img">
                    </div>
                    <div class="form-group">
                            <label>Tin Nổi Bật</label>
                            <label class="radio-inline">
                                <input name="noiBat" value="0" checked="" type="radio">Không
                            </label>
                            <label class="radio-inline">
                                <input name="noiBat" value="1" type="radio">Có
                            </label>
                        </div>
                    <button type="submit" class="btn btn-default">Thêm Tin</button>
                    <input type="button" class="btn btn-default" onClick="window.location.href=window.location.href" value="Tạo lại"> 
                <form>
            </div>
        </div>
        <!-- /.row -->
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