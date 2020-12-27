@if(isset($page_name) && $page_name=="index")
    <div id="carouselBlk">
        <div id="myCarousel" class="carousel slide">
            <div class="carousel-inner">
                @foreach($banners as $key => $banner)
                <div class="item @if($key == 0) active @endif">
                    <div class="container">
                        <a href="{{!empty($banner['link']) ? $banner['link'] : "#!"}}">
                            <img style="width:100%"
                                 src="{{asset('images/banner_images/'.$banner['image'])}}"
                                 alt="{{$banner['alt']}}"
                                title="{{$banner['title']}}"
                            />
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>

    </div>
@endif
