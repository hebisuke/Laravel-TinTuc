@extends('admin.layout.index')

@section('content')
    
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
                    <small>Thêm</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px" >
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
                <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label>Tên user</label>
                        <input class="form-control" name="tenUser" placeholder="Nhập tên user" minlength="3" required/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" name="email"  type="email"  placeholder="Nhập email" required/>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" name="passWord" id="password"  placeholder="Nhập mật khẩu" type="password" minlength="6" maxlength="32" required/>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input class="form-control" id="confirm_password"  placeholder="Nhập lại mật khẩu" type="password" minlength="6" maxlength="32" required/>
                    </div>
                    <div class="form-group">
                        <label>Phân quyền</label>
                        <label class="radio-inline">
                                <input name="quyen" value="0" type="radio">Thường
                        </label>
                        
                        <label class="radio-inline">
                            <input name="quyen" value="1" checked="" type="radio">Admin
                        </label>
                       
                    </div>
                    <button type="submit" class="btn btn-default">Thêm</button>
                    <button type="reset" class="btn btn-default">Reset</button>
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
    var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
    if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Mật khẩu nhập lại không chính xác");
    } else {
            confirm_password.setCustomValidity('');   
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>

@endsection