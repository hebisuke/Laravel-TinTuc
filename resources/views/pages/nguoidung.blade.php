@extends('layout.index')

@section('content')
    
<div class="row carousel-holder">
    <div class="col-md-2">
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
              <div class="panel-heading">Thông tin tài khoản</div>
              <div class="panel-body">
            <!-- /.col-lg-12 -->
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
                <form action="nguoidung/sua/{{$user->id}}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email"  value="{{$user->email}}" placeholder="Nhập email" readonly required/>
                    </div>

                    <div class="form-group">
                        <label>Tên user</label>
                        <input class="form-control" name="tenUser" value="{{$user->name}}" placeholder="Nhập tên user" minlength="3" required/>
                    </div>
                    
                    <div class="form-group">
                        <input type="checkbox" name="changePassword" id="changePassword">
                        <label>Đổi mật khẩu</label>
                        <input class="form-control" name="passWord" id="password" disabled placeholder="Nhập mật khẩu" type="password" minlength="6" maxlength="32" required/>
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input class="form-control" id="confirm_password" disabled placeholder="Nhập lại mật khẩu" type="password" minlength="6" maxlength="32" required/>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
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
    var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password"),changePassword = document.getElementById("changePassword");

    function validatePassword(){
    if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Mật khẩu nhập lại không chính xác");
    } else {
            confirm_password.setCustomValidity('');   
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

    function checkChangePassword(){
        if (changePassword.checked == true){
            password.disabled = false;
            confirm_password.disabled = false
        }else{
            password.disabled = true;
            confirm_password.disabled = true
        }
       
    }
    changePassword.onclick = checkChangePassword;
</script>

@endsection