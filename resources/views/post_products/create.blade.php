@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('partials.sidebarAds')
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
                                    <option value="">Thành phố</option>
                                    @foreach ($data['cities'] as $city)
                                    <option value="{{$city->code}}">
                                        {{$city->name_with_type}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="district" class="col-md-4 control-label">Quận / Huyện *</label>

                            <div class="col-md-6">
                                <select class="form-control" name="district_id" id="district">
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="ward" class="col-md-4 control-label">Phường / Xã *</label>

                            <div class="col-md-6">
                                <select class="form-control" name="ward_code" id="ward">
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
                                <div class="col-md-4">
                                <label class="radio-inline"><input type="radio" name="state" value="{{ \App\Models\PostProduct::NEW }}" checked>Còn mới</label>
                                </div>
                                <div class="col-md-4">
                                    <label class="radio-inline"><input type="radio" name="state" value="{{ \App\Models\PostProduct::SECONDHAND }}">Đã sử dụng</label>
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
