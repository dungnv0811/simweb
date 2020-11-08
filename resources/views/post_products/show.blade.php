@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('partials.sidebarAds')
        </div>

        <div class="col-sm-9 padding-right">
            <div class="product-details"><!--product-details-->
                <div class="col-sm-5">
                    <div class="view-product">
                        @if(empty(json_decode($post->images, true)))
                        <img src="{{url('/uploads/images/product/default.jpg')}}" alt="" />
                        @else
                        <img src="{{url('/uploads/images/product/'.json_decode($post->images, true)[0])}}" alt="" />
                        @endif
                    </div>
                    @if(!empty(json_decode($post->images, true)))
                    <div id="similar-product" class="carousel slide" data-ride="carousel">

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner">
                            @foreach (array_chunk(json_decode($post->images, true), 3) as $three)
                            <div class="item @if ($loop->first) active @endif">
                                @foreach($three as $image)
                                <a href=""><img src="{{url('/uploads/images/product/'.$image)}}" alt=""></a>
                                @endforeach
                            </div>
                            @endforeach
                        </div>

                        <!-- Controls -->
                        <a class="left item-control" href="#similar-product" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right item-control" href="#similar-product" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                    @endif

                </div>
                <div class="col-sm-7">
                    <div class="product-information"><!--/product-information-->
                        <h2>{{ $post->title }}</h2>
                        <p>Thông tin: {{ $post->short_description }}</p>
                        <span>
                            <span>{{ $post->price }}K VNĐ</span>
<!--                            @can('isAdmin')-->
<!--                            <button type="button" class="btn {{ ($post->status == 'published') ? 'btn-info' : 'btn-danger' }} btn-xs approve" value="{{ $post->id }}" id="post-show-approve-{{ $post->id }}"><i class="fa fa-lock"></i> {{ ($post->status == 'published') ? 'duyệt bài' : 'đóng bài' }}</button>-->
<!--                            @endcan-->
                        </span>
                        <p><b>Hãng:</b> {{ $post->branch }}</p>
                        <p><b>Đời máy:</b> {{ $post->model }}</p>
                        <p><b>Tình trạng:</b> {{ $post->state_label }}</p>
                        <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
                    </div><!--/product-information-->
                </div>
            </div><!--/product-details-->

            <div class="category-tab shop-details-tab"><!--category-tab-->
                <div class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#details" data-toggle="tab">Thông tin chi tiết</a></li>
                        <li><a href="#reviews" data-toggle="tab">Bình luận</a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="details">
                        <p style="padding:15px;">
                            {{ $post->description }}
                        </p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Người bán:</li>
                            <li class="list-group-item">Liên lạc:</li>
                            <li class="list-group-item">Địa chỉ: {{ $post->path_with_type }}</li>
                        </ul>
                        Bài đăng được tạo: {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
                    </div>

                    <div class="tab-pane fade" id="reviews" >
                        <div class="col-sm-12">
                            <ul>
                                <li><a href=""><i class="fa fa-user"></i>{{ $post->username }}</a></li>
                                <li><a href=""><i class="fa fa-clock-o"></i>{{ $post->created_at->toTimeString() }}</a></li>
                                <li><a href=""><i class="fa fa-calendar-o"></i>{{ $post->created_at->format('d M Y') }}</a></li>
                            </ul>
                            <p>{{ $post->description }}</p>

                            @include('partials.commentReply', ['comments' => $post->comments, 'post_id' => $post->id])
{{--                            <form method="post" action="javascript:void(0)" id="post-show-comment-form">--}}
{{--                                @csrf--}}
                                <div class="form-group" id="post-show-comment-form">
                                    <input type="text" name="comment_body" class="form-control" />
                                    <input type="hidden" name="post_id" value="{{ $post->id }}" />
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-warning btn-comment" value="Thêm bình luận" />
                                </div>
{{--                            </form>--}}
                        </div>
                    </div>

                </div>
            </div><!--/category-tab-->

        </div>
    </div>
</div>
{{ csrf_field() }}
@endsection

@push('javascript')

    {!! JsValidator::formRequest('App\Http\Requests\PostCommentRequest') !!}

    <script type="text/javascript">
    var _token = $('input[name="_token"]').val();

    $(document).on('click', '.approve', function(){
        var button = $(this)
        var id = $(this).attr("value");
        var text = $(this).text();
        if (confirm("Bạn có muốn "+text+" đăng này không?")) {
            $.ajax({
                url:"{{ route('admin.approvePost') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data) {
                    if ("{{ $post->status }}".localeCompare({{ \App\Models\PostProduct::APPROVED }})) {
                        button.html("đóng bài");
                    } else {
                        button.html("duyệt bài");
                    }
                }
            });
        }
    });


    $('.btn-comment').on('click', function (e) {
        e.preventDefault();
        let content = $('input[name ="comment_body"]').val();
        if (content) {
            $.ajax({
                url: '/comments',
                type: "POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {
                    post_id: "{{ $post->id }}",
                    comment_body: content,
                    "_token": "{{ csrf_token() }}"
                }
            }).done(function (data) {
                reloadCommentReply();
            }).error(function (jqXHR, ajaxOptions, thrownError) {
                if (jqXHR.status == 401) {
                    return alert('Đăng nhập tài khoản để bình luận');
                }
                if (jqXHR.status == 403) {
                    return document.location.href = '/email/verify';
                }
                return alert('No response from server');
            });
        }
    });

    function reloadCommentReply() {
       // TODO get the latest comment from post show
       var postId = "{{ $post->id }}";
       $.ajax({
            url: "/comments",
            type: "GET",
            data: {post_id:postId}
       }).done(function (data) {
           $("#post-comment-index-list").empty().html(data);
       }).error(function (jqXHR, ajaxOptions, thrownError) {
           alert('No response from server');
       });
    }

</script>
@endpush

