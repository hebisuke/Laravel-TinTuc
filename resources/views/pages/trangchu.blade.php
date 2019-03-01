    @extends('layout.index')
    @section('content')
            <!-- Page Content -->
    <div class="container">

		@include('layout.slide')

        <div class="space20"></div>


        <div class="row main-left">
			@include('layout.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Laravel Tin Tức</h2>
	            	</div>

	            	<div class="panel-body">
						@foreach ($theloai as $tl)
							<!-- item -->
						@if (count($tl->loaitin) > 0)
						<div class="row-item row">
								<h3>
									<a href="category.html">{{$tl->Ten}}</a> | 	
									@foreach ($tl->loaitin as $lt)
									<small><a href="loaitin/{{$lt->id}}/{{$lt->TenKhongDau}}.html"><i>{{$lt->Ten}}</i></a> /</small>
									@endforeach

								</h3>
								<?php
									$data = $tl->tintuc->where('NoiBat','=','1')->sortByDesc('create_at')->take(5);
									$tin1 = $data->shift();//cho phép lấy ra 1 phần từ trong data , và data chỉ con lại 4( ban đầu là 5) phần tử
								?>

								<div class="col-md-8 border-right">
									<div class="col-md-5">
										<a href="detail.html">
											<img class="img-responsive" src="/ckfinder/userfiles/images/{{$tin1['Hinh']}}" width="320px;" height="150px;" alt="">
										</a>
									</div>
	
									<div class="col-md-7">
										<h3>{!!$tin1['TieuDe']!!}</h3>
										<p>{!! $tin1['TomTat']!!} </p>
										<a class="btn btn-primary" href="tintuc/{{$tin1['id']}}/{{$tin1['TieuDeKhongDau']}}.html">Chi tiết <span class="glyphicon glyphicon-chevron-right"></span></a>
									</div>
	
								</div>
								
	
								<div class="col-md-4">
									@foreach ($data as $tt)
									<a href="detail.html">
											<h4>
												<span class="glyphicon glyphicon-list-alt"></span>
												{{$tt['']}}
											</h4>
										</a>
									@endforeach
								</div>
								
								<div class="break"></div>
							</div>
							<!-- end item -->
						@endif
							
						@endforeach
	            		


					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->

    @endsection
