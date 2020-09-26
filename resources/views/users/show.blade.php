@section('css')
<link href="{{ asset('css/user-profile.css') }}" rel="stylesheet">
@endsection

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('partials.sidebarAds')
        </div>
        <div class="col-sm-9 padding-right" id="posts-index-id">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Thông tin cá nhân</h2>
                </div>
            </div>
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Đổi avatar
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                {{ $user->name}}
                            </h5>
                            <h6>
                                Email: {{ $user->email}}
                            </h6>
                            <p class="profile-rating">RANKINGS : <span>8/10</span></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="cập nhật"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <table class="table table-striped custab">
                            <tr>
                                <th>Tên:</th>
                                <th>{{ $user->name}}</th>
                            </tr>
                            <tr>
                                <th>Thông tin:</th>
                                <th>thêm vào</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="user-show-id">
                        <h2 class="title text-center">Bài đã đăng</h2>
                        @include('partials.ajaxUserPost')
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('javascript')
<script type="text/javascript">
    $(window).on('hashchange', function() {
        if (window.location.hash) {
            var page = window.location.hash.replace('#', '');
            if (page == Number.NaN || page <= 0) {
                return false;
            }else{
                getData(page);
            }
        }
    });

    $(document).ready(function()
    {
        $(document).on('click', '.page-link',function(event)
        {
            event.preventDefault();

            $('li').removeClass('active');
            $(this).parent('li').addClass('active');

            var page=$(this).attr('href').split('page=')[1];

            getData(page);
        });

    });

    function getData(page){
        $.ajax(
            {
                url: '?page=' + page,
                type: "get",
                datatype: "html"
            }).done(function(data){
            $("#user-show-id").empty().html(data);
            location.hash = page;
        }).fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });
    }

    var _token = $('input[name="_token"]').val();
    $(document).on('click', '.delete', function(){
        var id = $(this).attr("value");
        var page = $('.page-item.active').text();
        if (confirm("Bạn có muốn xóa dữ liệu này không?")) {
            $.ajax({
                url:"{{ route('posts.delete') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data)
                {
                    getData(page);
                }
            });
        }
    });

</script>
@endpush
