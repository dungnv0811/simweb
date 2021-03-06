<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Bài đăng nổi bật</h2>

    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach ($recommendedPosts->chunk(3) as $three)
            <div class="item @if ($loop->first) active @endif">
                @foreach($three as $recommendedPost)
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                @if(empty(json_decode($recommendedPost->images, true)))
                                <img src="{{url('/uploads/images/product/default.jpg')}}" alt="" />
                                @else
                                <img src="{{url('/uploads/images/product/'.json_decode($recommendedPost->images, true)[0])}}" alt="" style="width: 255px; height: 453px"  />
                                @endif

                                <h2>{{ $recommendedPost->price_unit }}K VNĐ</h2>
                                <p>{{ $recommendedPost->title }}</p>
                                <p><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($recommendedPost->created_at)->diffForHumans()}}</p>
                                <a href="{{ route('posts.show', $recommendedPost->slug) }}" class="btn btn-info"><i class="fa fa-info-circle"></i> Chi tiết</a>
                            </div>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>
        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
        </a>
        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
        </a>
    </div>
</div><!--/recommended_items-->

<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Bài đăng mới (Tìm thấy {!! $posts->total() !!} bài)</h2>
        @foreach ($posts as $post)
        <div class="col-sm-4">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        @if(empty(json_decode($post->images, true)))
                        <img src="{{url('/uploads/images/product/default.jpg')}}" alt="" style="width: 255px; height: 453px" />
                        @else
                        <img src="{{url('/uploads/images/product/'.json_decode($post->images, true)[0])}}" alt="" style="width: 255px; height: 453px" />
                        @endif
                        <h2>{{ $post->price_unit }}K VNĐ</h2>
                        <p>{{ $post->title }}</p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-default add-to-cart"><i class="fa fa-info-circle"></i>Chi tiết</a>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><i class="fa fa-group"></i>Hãng: {{ $post->branch }}</li>
                        <li><i class="fa fa-clock-o"></i> {{ Carbon\Carbon::parse($post->created_at)->diffForHumans()}}</li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        <div class="text-center">
            {!! $posts->render() !!}
        </div>
</div><!--features_items-->
