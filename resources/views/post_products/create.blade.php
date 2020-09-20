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
                    <img src="images/home/shipping.jpg" alt="" />
                </div><!--/shipping-->

            </div>
        </div>

        <div class="col-sm-9 padding-right">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="title text-center">Đăng bài mới</h2>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="city" class="col-md-4 control-label">Thành Phố *</label>

                            <div class="col-md-6">
                                <select class="form-control" name="city_id" id="city">
                                    <option value="">@lang('common.please_select')</option>
                                    @foreach ($data['cities'] as $city)
                                    <option value="{{$city->id}}">
                                        {{$city->body}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="district" class="col-md-4 control-label">Quận / Huyện *</label>

                            <div class="col-md-6">
                                <select class="form-control" name="district_id" id="district">
                                    <option value="">@lang('common.please_select')</option>
                                    @foreach ($data['districts'] as $district)
                                        <option value="{{$district->id}}">
                                            {{$district->body}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ward" class="col-md-4 control-label">Phường / Xã *</label>

                            <div class="col-md-6">
                                <select class="form-control" name="ward_id" id="ward">
                                    <option value="">@lang('common.please_select')</option>
                                    @foreach ($data['wards'] as $ward)
                                        <option value="{{$ward->id}}">
                                            {{$ward->body}}
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="street" class="col-md-4 control-label">Tên đường *</label>

                            <div class="col-md-6">
                                <input id="street" type="text" class="form-control" name="street" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="title" class="col-md-4 control-label">Tiêu đề *</label>
                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Mô tả *</label>

                            <div class="col-md-6">
                                <textarea id="description" type="textarea" class="form-control" name="description" required value="{{ old('description') }}" rows = "10"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Tình trạng</label>

                            <div class="col-md-6" class="radio-inline">
                                <div class="col-md-6">
                                <label class="radio-inline"><input type="radio" name="status" value="{{ \App\Models\PostProduct::NEW }}" checked>Còn mới</label>
                                </div>
                                <div class="col-md-6">
                                    <label class="radio-inline"><input type="radio" name="status" value="{{ \App\Models\PostProduct::SECONDHAND }}">Đã qua sử dụng</label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="branch" class="col-md-4 control-label">Hãng *</label>

                            <div class="col-md-6">
                                <input id="branch" type="text" class="form-control" name="branch">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="model" class="col-md-4 control-label">Đời máy</label>

                            <div class="col-md-6">
                                <input id="model" type="text" class="form-control" name="model">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-md-4 control-label">Giá (VNĐ) *</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control" name="price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="" placeholder="1,000,000">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="description" class="col-md-4 control-label">Đăng ảnh *</label>
                            <div class="col-md-6">
                                <input type="file" id="posts-create-id" name="images[]" required class="form-control" multiple/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="preview-images-zone col-md-8 col-md-offset-2">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-5">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    Đăng Bài
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



@push('javascript')
    {!! JsValidator::formRequest('App\Http\Requests\PostProductRequest') !!}
<script type="text/javascript">
    $(document).ready(function() {
        document.getElementById('posts-create-id').addEventListener('change', readImage, false);

        $( ".preview-images-zone" ).sortable();

        $(document).on('click', '.image-cancel', function() {
            let no = $(this).data('no');
            $(".preview-image.preview-show-"+no).remove();
        });
    });

    var num = 4;
    function readImage() {
        if (window.File && window.FileList && window.FileReader) {
            var files = event.target.files; //FileList object
            var output = $(".preview-images-zone");

            for (let i = 0; i < files.length; i++) {
                var file = files[i];
                if (!file.type.match('image')) continue;

                var picReader = new FileReader();

                picReader.addEventListener('load', function (event) {
                    var picFile = event.target;
                    var html =  '<div class="preview-image preview-show-' + num + '">' +
                        '<div class="image-cancel" data-no="' + num + '">x</div>' +
                        '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                        '</div>';

                    output.append(html);
                    num = num + 1;
                });

                picReader.readAsDataURL(file);
            }
        } else {
            console.log('Browser not support');
        }
    }



    $('#city').change(function(){
        var cid = $(this).val();
        if(cid){
            $.ajax({
                type:"get",
                url:"{{url('/cities')}}/"+cid+"/districts",
                success:function(res)
                {
                    if(res)
                    {
                        $("#district").empty();
                        $("#ward").empty();
                        $("#district").append('<option>@lang('common.please_select')</option>');
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
                    if(res)
                    {
                        $("#ward").empty();
                        $("#ward").append('<option>@lang('common.please_select')</option>');
                        $.each(res,function(key,value){
                            $("#ward").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }

            });
        }
    });

</script>
<script src="{{ asset('js/currency.js') }}"></script>
@endpush