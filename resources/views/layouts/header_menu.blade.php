<div class="header-bottom"><!--header-bottom-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <form class="" action="studentSearch" method="get" id="post-index-search-form">

                    <div class="col-sm-2">
                        <select class="form-control" name="city" id="city">
                            <option value="">Thành phố</option>
                            @foreach ($cities as $city)
                            <option value="{{$city->id}}">
                                {{$city->body}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <select class="form-control" name="district" id="district">
                        </select>
                    </div>

                    <div class="col-sm-2">
                        <select class="form-control" name="ward" id="ward">
                        </select>
                    </div>
                    <div class="col-sm-4">
                        <input class="form-control pull-right" name="title" type="text" placeholder="Search" aria-label="Search">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-success pull-right"><i class="fa fa-search"></i>&nbsp;Tìm kiếm</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!--/header-bottom-->
