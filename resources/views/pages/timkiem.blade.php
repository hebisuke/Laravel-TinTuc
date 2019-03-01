@extends('layout.index');
@section('content')

<!-- Page Content -->
<div class="container">
        <div class="row">
            @include('layout.menu')

            @php
                function highlight($text, $words) {
                    $highlighted = preg_filter('/' . preg_quote($words, '/') . '/i', '<b><span style="color: red;background: yellow;">$0</span></b>', $text);
                    if (!empty($highlighted)) {
                        $text = $highlighted;
                    }
                    return $text;
                }
                function doimau($str,$tukhoa){
                    return str_replace($tukhoa,"<span class='highlight' style='color: red;background: yellow;'>$tukhoa</span>",$str);
                }
            @endphp
            <div class="col-md-9 ">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;">
                        <h4><b>Tìm kiếm : {{$tukhoa}}</b></h4>
                    </div>
                    @foreach ($tintuc as $tt)
                    <div class="row-item row">
                            <div class="col-md-3">
    
                                <a href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">
                                    <br>
                                    <img width="200px" height="200px" class="img-responsive" src="/ckfinder/userfiles/images/{{$tt->Hinh}}" alt="">
                                </a>
                            </div>
    
                            <div class="col-md-9">
                                <h3>{!! highlight($tt->TieuDe,$tukhoa)!!}</h3>
                                <p>{!! highlight($tt->TomTat,$tukhoa)!!}</p>
                                <a class="btn btn-primary" href="tintuc/{{$tt->id}}/{{$tt->TieuDeKhongDau}}.html">Chi tiết<span class="glyphicon glyphicon-chevron-right"></span></a>
                            </div>
                            <div class="break"></div>
                        </div>
    
                    @endforeach

                    

                    <!-- Pagination -->
                    <div class="row text-center">
                        <div class="col-lg-12">
                           {{-- {{$tintuc->links()}} --}}
                           {{ $tintuc->appends(Request::all())->links() }}
                        </div>
                    </div>
                    <!-- /.row -->

                </div>
            </div> 

        </div>

    </div>
    <!-- end Page Content -->

@endsection
