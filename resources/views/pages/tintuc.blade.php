@extends('layout.index')

@section('content')
       <!-- Page Content -->
       <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$tintuc->TieuDe}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Admin</a>
                </p>

                <!-- Preview Image -->
                {{-- //http://placehold.it/900x300 --}}
                <img class="img-responsive" src="/ckfinder/userfiles/images/{{$tintuc->Hinh}}" alt="" width="500px;;" height="250px;">

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$tintuc->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $tintuc->NoiDung !!}</p>
                

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    @if (Auth::check())
                    @if(session('thongbao'))
                        <div class = "alert alert-success">
                             {{session('thongbao')}}
                        </div>
                    @endif
                    <h4>Viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    <form role="form" action="binhluan/{{ $tintuc->id }}" method="POST">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <textarea class="form-control"  name="NoiDung" rows="3" maxlength="255" required ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </form>
                    @else
                    <h4>Đăng nhập để viết bình luận ...<span class="glyphicon glyphicon-pencil"></span></h4>
                    @endif
                    
                </div>

                <hr>

                <!-- Posted Comments -->
                @foreach ($comment as $cm)
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$cm->user->name}}
                            <small>{{$cm->created_at}}</small>
                        </h4>
                        {{$cm->NoiDung}}
                    </div>
                </div>
                @endforeach
                

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin liên quan</b></div>
                    <div class="panel-body">
                        @foreach ($tinLienQuan as $tlq)
                            
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="/ckfinder/userfiles/images/{{$tlq->Hinh}}" width="78.531px;" height="78.531" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tlq->id}}/{{$tlq->TieuDeKhongDau}}.html"><b>{{$tlq->TieuDe}}</b></a>
                            </div>
                            <p style="padding-left: 5px;">{!!$tlq->TomTat!!}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->

                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        @foreach ($tinNoiBat as $tnb)
                        <!-- item -->
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="tintuc/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html">
                                    <img class="img-responsive" src="/ckfinder/userfiles/images/{{$tnb->Hinh}}" width="78.531px;" height="78.531" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="tintuc/{{$tnb->id}}/{{$tnb->TieuDeKhongDau}}.html"><b>{{$tnb->TieuDe}}</b></a>
                            </div>
                            <p padding-left: 5px;>{!!$tnb->TomTat!!}</p>
                            <div class="break"></div>
                        </div>
                        <!-- end item -->

                        @endforeach

                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection