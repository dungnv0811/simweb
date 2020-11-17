@extends('layouts.app')
@section('css')
<link href="{{ asset('css/swipper.css') }}" rel="stylesheet">
@endsection

@section('slider')
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- Slider main container -->
                <div class="swiper-container main-slider" id="myCarousel">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide slider-bg-position index-slide1" data-hash="slide1" onclick="location.href='https://www.facebook.com/KyGoi-105141441394776';">
<!--                            <h2>It is health that is real wealth and not pieces of gold and silver</h2>-->
                        </div>
                        <div class="swiper-slide slider-bg-position index-slide2" data-hash="slide2" onclick="location.href='https://www.facebook.com/KyGoi-105141441394776';">
<!--                            <h2>Happiness is nothing more than good health and a bad memory</h2>-->
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                    <!-- Add Navigation -->
                    <div class="swiper-button-prev"><i class="fa fa-angle-left"></i></div>
                    <div class="swiper-button-next"><i class="fa fa-angle-right"></i></div>
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
<script src="{{ asset('js/swipper.js') }}"></script>
<script type="text/javascript">

    var swiper = new Swiper('.swiper-container', {
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },
          autoplay: {
            delay: 3000,
          },
        });

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
