<!-- Modal -->
<div class="modal fade" id="admin-index-edit-post-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h2 class="title text-center">Chỉnh sửa bài đăng</h2>
            </div>
            <form class="form-horizontal" method="POST" action="" id="admin-post-edit-form">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('isRecommended') ? ' has-error' : '' }}">
                    <label for="isRecommended" class="col-md-4 control-label">Bài đăng nổi bật</label>

                    <div class="col-md-6">
                        <label class="radio-inline"><input type="radio" id="unrecommended" name="is_recommended" value="0" checked>Bình thường</label>
                        <label class="radio-inline"><input type="radio" id="isRecommended" name="is_recommended" value="1">Nổi bật</label>
                        @if ($errors->has('isRecommended'))
                        <span class="help-block">
                            <strong>{{ $errors->first('isRecommended') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                    <label for="title" class="col-md-4 control-label">Tiêu đề *</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required>

                        @if ($errors->has('title'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                    <label for="description" class="col-md-4 control-label">Mô tả *</label>

                    <div class="col-md-6">
                        <textarea id="description" type="textarea" class="form-control" name="description" required value="{{ old('description') }}" rows = "10"></textarea>

                        @if ($errors->has('description'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                    <label for="state" class="col-md-4 control-label">Tình trạng</label>

                    <div class="col-md-6">
                        <label class="radio-inline"><input type="radio" id="state-new" name="state" value="0" checked>Còn mới</label>
                        <label class="radio-inline"><input type="radio" id="state-old" name="state" value="1">Đã qua sử dụng</label>
                        @if ($errors->has('state'))
                        <span class="help-block">
                            <strong>{{ $errors->first('state') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('branch') ? ' has-error' : '' }}">
                    <label for="branch" class="col-md-4 control-label">Hãng *</label>

                    <div class="col-md-6">
                        <input id="branch" type="text" class="form-control" name="branch">
                        @if ($errors->has('branch'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('branch') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('model') ? ' has-error' : '' }}">
                    <label for="model" class="col-md-4 control-label">Đời máy</label>

                    <div class="col-md-6">
                        <input id="model" type="text" class="form-control" name="model">
                        @if ($errors->has('model'))
                        <span class="help-block">
                                        <strong>{{ $errors->first('model') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
                    <label for="price" class="col-md-4 control-label">Giá (VNĐ) *</label>

                    <div class="col-md-6">
                        <input id="price" type="text" class="form-control" name="price" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?" data-type="currency" value="{{ old('price') }}" placeholder="1,000,000">
                        @if ($errors->has('price'))
                        <span class="help-block">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button class="btn btn-secondary btn-lg" data-dismiss="modal">
                            Đóng popup
                        </button>
                        <button class="btn btn-danger btn-lg updateBtn">
                            Xác nhận
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
