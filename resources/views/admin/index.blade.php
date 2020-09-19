@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('partials.sidebar')
        </div>
        <div class="col-sm-9" id="admin-index-id">
            @include('partials.ajaxAdminPost')
        </div>
    </div>
</div>
@endsection

@section('javascript')
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
                type: "GET",
                datatype: "html"
            }).done(function(data){
            $("#admin-index-id").empty().html(data);
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

    $(document).on('click', '.approve', function(){
        var id = $(this).attr("value");
        var text = $(this).text();
        var page = $('.page-item.active').text();
        if (confirm("Bạn có muốn "+text+" đăng này không?")) {
            $.ajax({
                url:"{{ route('admin.approvePost') }}",
                method:"POST",
                data:{id:id, _token:_token},
                success:function(data)
                {
                    getData(page);
                }
            });
        }
    });

    $(document).on('click', '.edit', function(){
        var id = $(this).attr("value");
        var title = $("[name=hidden-title-"+ id +"]").val();
        var description = $("[name=hidden-description-"+ id +"]").val();
        var isRecommended = $("[name=hidden-isRecommended-"+ id +"]").val();
        var state = $("[name=hidden-state-"+ id +"]").val();
        var status = $("[name=hidden-status-"+ id +"]").val();
        var branch = $("[name=hidden-branch-"+ id +"]").val();
        var model = $("[name=hidden-model-"+ id +"]").val();
        var price = $("[name=hidden-price-"+ id +"]").val();
        if (isRecommended) {
            $("#isRecommended").prop("checked", true);
        } else {
            $("#unrecommended").prop("checked", true);
        }
        $("#title").val(title);
        $("#description").val(description);
        if (state) {
            $("#state-new").prop("checked", true);
        } else {
            $("#state-old").prop("checked", true);
        }
        $("#status").val(status);
        $("#branch").val(branch);
        $("#model").val(model);
        $("#price").val(price);
        $("[name=hidden-post-id]").val(id);
    });

    $(document).on('click', '.updateBtn', function(){
        var page = $('.page-item.active').text();
        var id = $("[name=hidden-post-id]").val();
        var isRecommended = $("#isRecommended").val();
        var title = $("#title").val();
        var description = $("#description").val();
        var state = $("#state").val();
        var status = $("#status").val();
        var branch = $("#branch").val();
        var model = $("#model").val();
        var price = $("#price").val();
        var data = {
            id: $("[name=hidden-post-id]").val(),
            isRecommended: $("#isRecommended").val(),
            title: $("#title").val(),
            description: $("#description").val(),
            state: $("#state").val(),
            status: $("#status").val(),
            branch: $("#branch").val(),
            model: $("#model").val(),
            price: $("#price").val(),
            _token:_token
        };

        $.ajax({
            url:"{{ route('admin.updatePost') }}",
            method:"POST",
            data: data,
            success:function(data) {
                getData(page);
            }
        });

        $("#admin-index-edit-post-model").modal("hide");
        // prevent submit form
        return false;
    })

</script>

<script src="{{ asset('js/currency.js') }}"></script>
@endsection
