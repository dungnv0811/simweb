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
                                <img src="images/home/recommend1.jpg" alt="" />
                                <h2>$56</h2>
                                <p>{{ $recommendedPost->title }}</p>
                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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
                        <img src="images/home/product2.jpg" alt="" />
                        <h2>$56</h2>
                        <p>{{ $post->title }}</p>
                        <a href="{{ route('posts.show', $post->id) }}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Xem bài</a>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </div>
        @endforeach
        <div class="text-center">
            {!! $posts->render() !!}
        </div>
</div><!--features_items-->
