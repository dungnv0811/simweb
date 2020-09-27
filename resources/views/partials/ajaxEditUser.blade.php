<!-- Modal -->
<div class="modal fade" id="show-edit-user-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h2 class="title text-center">Chỉnh sửa người dùng</h2>
            </div>
            <form class="form-horizontal" method="POST" action="" id="user-edit-form">
                {{ csrf_field() }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Tên *</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>

                        @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('isRecommended') ? ' has-error' : '' }}">
                    <label for="isRecommended" class="col-md-4 control-label">Giới tính</label>

                    <div class="col-md-6">
                        <label class="radio-inline"><input type="radio" id="undefined" name="gender" value="0" checked>Chưa xác định</label>
                        <label class="radio-inline"><input type="radio" id="male" name="gender" value="1">Nam</label>
                        <label class="radio-inline"><input type="radio" id="female" name="gender" value="2">Nữ</label>
                        @if ($errors->has('gender'))
                        <span class="help-block">
                            <strong>{{ $errors->first('gender') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email" class="col-md-4 control-label">Email *</label>

                    <div class="col-md-6">
                        <input id="email" type="text" class="form-control" name="email" value="{{ $user->email }}" required>

                        @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                    <label for="phone" class="col-md-4 control-label">Số điện thoại *</label>

                    <div class="col-md-6">
                        <input id="phone" type="text" class="form-control" name="phone" value="{{ $user->phone }}" required>
                        @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                    <label for="address" class="col-md-4 control-label">Địa chỉ</label>

                    <div class="col-md-6">
                        <input id="address" type="text" class="form-control" name="address" value="{{ $user->address }}">
                        @if ($errors->has('address'))
                        <span class="help-block">
                            <strong>{{ $errors->first('address') }}</strong>
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
