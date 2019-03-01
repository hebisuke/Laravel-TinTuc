@extends('admin.layout.index')

@section('content')

<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại Tin
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

                <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                            <label>Tên Loại Tin</label>
                        <input class="form-control" name="tenLoaiTin" placeholder="Nhập tên Loại Tin"  value="{{$loaitin->Ten}}"/>
                        </div>
    
                        <div class="form-group">
                            <label>Category Parent</label>
                            <select class="form-control"  name="idTheLoai">
                                @foreach ($theloai as $tl)
                                <option 
                                    @if ($tl->id == $loaitin->idTheLoai)
                                        {{'selected'}}
                                    @endif

                                value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endforeach
                            </select>
                        </div>
                    <button type="submit" class="btn btn-default">Sửa Loại Tin</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>    
@endsection