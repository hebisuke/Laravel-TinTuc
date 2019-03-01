 @extends('layout.index')

 @section('content')
     

 <!-- Page Content -->
 <div class="container">

    <!-- slider -->
    <div class="row carousel-holder">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <div class="panel panel-default">
                  <div class="panel-heading">Đăng nhập</div>
                  <div class="panel-body">
                    @if(count($errors) > 0)
                    <div class="alert alert-danger">
                            @foreach ($errors->all() as $err)
                                {{$err}}<br>
                            @endforeach
                        
                    </div> 
                    @endif

                    @if(session('thongbao'))
                        <div class = "alert alert-danger">
                             {{session('thongbao')}}
                        </div>
                    @endif

                    @if(session('thongbao2'))
                    <div class = "alert alert-success">
                         {{session('thongbao2')}}
                    </div>
                @endif
                    <form action="dangnhap" method="POST" >
                        {{ csrf_field() }}
                        <div>
                            <label>Email</label>
                              <input type="email" class="form-control" placeholder="Email" name="email" required>
                        </div>
                        <br>	
                        <div>
                            <label>Mật khẩu</label>
                              <input type="password" class="form-control" name="password" minlength="6" maxlength="32" required>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-default">Đăng nhập
                        </button>
                    </form>
                  </div>
            </div>
        </div>
        <div class="col-md-4"></div>
    </div>
    <!-- end slide -->
</div>
<!-- end Page Content -->

@endsection