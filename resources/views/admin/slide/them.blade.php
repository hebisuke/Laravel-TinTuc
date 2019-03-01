@extends('admin.layout.index')

@section('content')
    
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
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
                <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Tên slide</label>
                        <input class="form-control" name="tenSlide" placeholder="Nhập tên slide" maxlength="255" minlength="3" required/>
                    </div>
                    <div class="form-group">
                        <label>Nội dung</label>
                        <input class="form-control" name="noiDung" placeholder="Nhập nội dung slide" maxlength="255"  minlength="3" required/>
                    </div>
                    <div class="form-group">
                            <input onclick="openPopup()" type="button" value="Chọn hình">
                            <input type="text" size="48" name="url" id="url" placeholder="Chọn Hình" />
                            <img src="" alt="" width="450px" id="img" style="margin-top: 10px;">
                        </div>

                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default" onClick="window.location.href=window.location.href">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection