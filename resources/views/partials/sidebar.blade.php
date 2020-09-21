<div class="left-sidebar">
    <form class="" action="studentSearch" method="get" id="post-index-search-form">
        <div class="brands_products"><!--brands_products-->
            <div class="form-group">
                <input class="form-control" name="title" type="text" placeholder="Tìm kiếm" aria-label="Search">
            </div>

            <div class="row">

            </div>
            <h2>Tìm kiếm nâng cao</h2>

            <div class="form-group">
                <select class="form-control" name="city" id="city">
                    <option value="">Thành phố</option>
                @foreach ($cities as $city)
                    <option value="{{$city->code}}">
                        {{$city->name_with_type}}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="district" id="district">
                </select>
            </div>

            <div class="form-group">
                <select class="form-control" name="ward" id="ward">
                </select>
            </div>

        </div><!--/brands_products-->

        <div class="price-range"><!--price-range-->
            <h2>Giá tiền (triệu đồng)</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="20" data-slider-step="2" data-slider-value="[0,20]" id="posts-index-sidebar" >
                <b class="pull-left">0 Triệu</b> <b class="pull-right">20 Triệu</b>
            </div>
        </div><!--/price-range-->
        <div class="form-group">
            <button type="submit" class="btn btn-success btn-block"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
        </div>
    </form>
</div>
