@extends('layout.index')

@section('content')
    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Đăng ký tài khoản</div>
				  	<div class="panel-body">
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
                    <form action="dangky" method="POST" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-default">Thêm</button>
                        <button type="reset" class="btn btn-default">Reset</button>
                    <form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
    
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