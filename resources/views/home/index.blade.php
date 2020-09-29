@extends('layouts.app')
@section('slider')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <li data-target="#slider-carousel" data-slide-to="2"></li>
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free E-Commerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
<!--                                <img src="images/home/girl1.jpg" class="girl img-responsive" alt=""/>-->
<!--                                <img src="images/home/pricing.png" class="pricing" alt=""/>-->
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>100% Responsive Design</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
<!--                                <img src="images/home/girl2.jpg" class="girl img-responsive" alt=""/>-->
<!--                                <img src="images/home/pricing.png" class="pricing" alt=""/>-->
                            </div>
                        </div>

                        <div class="item">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>Free Ecommerce Template</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                    incididunt ut labore et dolore magna aliqua. </p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
<!--                                <img src="images/home/girl3.jpg" class="girl img-responsive" alt=""/>-->
<!--                                <img src="images/home/pricing.png" class="pricing" alt=""/>-->
                            </div>
                        </div>

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </div>
</section><!--/slider-->
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('partials.sidebar')
        </div>
        <div class="col-sm-9 padding-right" id="posts-index-id">
            @if(session('message'))
                @include('partials.message_notice')
            @endif
            @include('partials.ajaxPost')
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
            } else{
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


    // search function

    $('#city').change(function(){
        var cid = $(this).val();
        if (cid) {
            $.ajax({
                type:"get",
                url:"{{url('/cities')}}/"+cid+"/districts",
                success:function(res)
                {
                    if(res)
                    {
                        $("#district").empty();
                        $("#ward").empty();
                        $("#district").append('<option value="">Quận / huyện</option>');
                        $.each(res,function(key,value){
                            $("#district").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }

            });
        }
    });
    $('#district').change(function(){
        var sid = $(this).val();
        if(sid){
            $.ajax({
                type:"get",
                url:"{{url('/districts')}}/"+sid+"/wards",
                success:function(res)
                {
                    if(res) {
                        $("#ward").empty();
                        $("#ward").append('<option value="">Phường / xã</option>');
                        $.each(res,function(key,value){
                            $("#ward").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }

            });
        }
    });
    $('#post-index-search-form').on('submit', function (e){
        e.preventDefault();
        // need to return to first page because of search function
        getData('1');
    });

    function getData(page) {
        var formData = $('#post-index-search-form').serialize();
        $.ajax({
            url: '?page=' + page,
            type: "GET",
            data: formData
        }).done(function (data) {
            $("#posts-index-id").empty().html(data);
            location.hash = page;
        }).fail(function (jqXHR, ajaxOptions, thrownError) {
            alert('No response from server');
        });
    }
</script>
@endpush
