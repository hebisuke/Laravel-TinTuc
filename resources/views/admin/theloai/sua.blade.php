@extends('admin.layout.index')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể Loại
                    <small>Sửa thể loại</small>
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
                <form action="admin/theloai/sua/{{$theloai->id}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Tên Thể Loại</label>
                        <input class="form-control" name="tenTheLoai" placeholder="Nhập Tên Thể Loại" value= "{{$theloai->Ten}}" />
                    </div>
                    <button type="submit" class="btn btn-default">Xác nhận Sửa</button>
                    <button type="reset" class="btn btn-default">Tạo Lại</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>    
@endsection