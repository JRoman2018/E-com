@extends('layouts.front_layout.front_layout')

@section('content')
<div class="span9">
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{$featuredItemsCount}}+ featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" class="carousel slide">
                <div class="carousel-inner">
                    @foreach($featuredItemsChunk as $key => $featuredItem)
                        <div class="item @if($key==1) active @endif">
                            <ul class="thumbnails">
                                @foreach($featuredItem as $item)
                                <li class="span3">
                                    <div class="thumbnail">
                                        <i class="tag"></i>
                                        <a href="product_details.html">
                                            <?php $product_image_path = 'images/product_images/small/'.$item['main_image'];?>
                                            @if(!empty($item['main_image']) && file_exists($product_image_path))
                                                <img src="{{url($product_image_path)}}" alt="">
                                            @else
                                                <img src="{{url('images/product_images/small/no-image.png')}}" alt="">
                                            @endif
                                        </a>
                                        <div class="caption">
                                            <h5>{{$item['product_name']}}</h5>
                                            <h4><a class="btn" href="product_details.html">VIEW</a> <span class="pull-right">RD$ {{$item['product_price']}}</span></h4>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    @endforeach
                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{url('images/front_images/products/6.jpg')}}" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>

                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{url('images/front_images/products/7.jpg')}}" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{url('images/front_images/products/8.jpg')}}" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{url('images/front_images/products/9.jpg')}}" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{url('images/front_images/products/10.jpg')}}" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
        <li class="span3">
            <div class="thumbnail">
                <a  href="product_details.html"><img src="{{url('images/front_images/products/11.jpg')}}" alt=""/></a>
                <div class="caption">
                    <h5>Product name</h5>
                    <p>
                        Lorem Ipsum is simply dummy text.
                    </p>
                    <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">Rs.1000</a></h4>
                </div>
            </div>
        </li>
    </ul>
</div>
@endsection()
