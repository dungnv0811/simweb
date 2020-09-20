@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Category</h2>
                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    Sportswear
                                </a>
                            </h4>
                        </div>
                        <div id="sportswear" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <li><a href="#">Nike </a></li>
                                    <li><a href="#">Under Armour </a></li>
                                    <li><a href="#">Adidas </a></li>
                                    <li><a href="#">Puma</a></li>
                                    <li><a href="#">ASICS </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#mens">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    Mens
                                </a>
                            </h4>
                        </div>
                        <div id="mens" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <li><a href="#">Fendi</a></li>
                                    <li><a href="#">Guess</a></li>
                                    <li><a href="#">Valentino</a></li>
                                    <li><a href="#">Dior</a></li>
                                    <li><a href="#">Versace</a></li>
                                    <li><a href="#">Armani</a></li>
                                    <li><a href="#">Prada</a></li>
                                    <li><a href="#">Dolce and Gabbana</a></li>
                                    <li><a href="#">Chanel</a></li>
                                    <li><a href="#">Gucci</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordian" href="#womens">
                                    <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                    Womens
                                </a>
                            </h4>
                        </div>
                        <div id="womens" class="panel-collapse collapse">
                            <div class="panel-body">
                                <ul>
                                    <li><a href="#">Fendi</a></li>
                                    <li><a href="#">Guess</a></li>
                                    <li><a href="#">Valentino</a></li>
                                    <li><a href="#">Dior</a></li>
                                    <li><a href="#">Versace</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#">Kids</a></h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#">Fashion</a></h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#">Households</a></h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#">Interiors</a></h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#">Clothing</a></h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#">Bags</a></h4>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="#">Shoes</a></h4>
                        </div>
                    </div>
                </div><!--/category-products-->

                <div class="brands_products"><!--brands_products-->
                    <h2>Brands</h2>
                    <div class="brands-name">
                        <ul class="nav nav-pills nav-stacked">
                            <li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
                            <li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
                            <li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
                            <li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
                            <li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
                            <li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
                            <li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
                        </ul>
                    </div>
                </div><!--/brands_products-->

                <div class="price-range"><!--price-range-->
                    <h2>Price Range</h2>
                    <div class="well text-center">
                        <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                        <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
                    </div>
                </div><!--/price-range-->

                <div class="shipping text-center"><!--shipping-->
                    <img src="{{url('/images/home/shipping.jpg')}}" alt="" />
                </div><!--/shipping-->

            </div>
        </div>
        <div class="col-sm-9" id="admin-index-id">
            @include('partials.ajaxAdminPost')
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
@endpush
