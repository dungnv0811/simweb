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
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS52y5aInsxSm31CvHOFHWujqUx_wWTS9iM6s7BAm21oEN_RiGoog" style="" alt=""/>
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
                    </div>
                </div>
                <div class="col-md-2">
                    <a class="profile-edit-btn edit btn btn-info" value="{{ $user->id }}" id="show-edit-{{ $user->id }}" data-toggle="modal" data-target="#show-edit-user-model">cập nhật</a>
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
                            <th>Giới tính:</th>
                            <th>{{ $user->gender_label}}</th>
                        </tr>
                        <tr>
                            <th>Số điện thoại:</th>
                            <th>{{ $user->phone}}</th>
                        </tr>
                        <tr>
                            <th>Địa chỉ:</th>
                            <th>{{ $user->address}}</th>
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
        </div>
    </div>
</div>

@include('partials.ajaxEditUser')
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


    $(document).on('click', '.updateBtn', function(){
        var data = {
            id: "{{ $user->id }}",
            name: $("#name").val(),
            gender: $('input[name ="gender"]').val(),
            email: $("#email").val(),
            phone: $("#phone").val(),
            address: $("#address").val(),
            _token:_token
        };
        var page = $('.page-item.active').text();


        $.ajax({
            url:"{{ route('users.update', $user->id) }}",
            method:"PUT",
            data: data,
            success:function(data) {
                location.reload();
            }

        });

        $("#show-edit-user-model").modal("hide");
        // prevent submit form
        return false;
    })

</script>
@endpush
