<div class="row">
    <div class="col-sm-12">
        <h2 class="title text-center">Quản lý bài đăng</h2>
    </div>
</div>

<table class="table table-striped custab">
    <thead>
    <tr>
        <th>Tên bài</th>
        <th>Ngày đăng</th>
        <th>Trạng thái</th>
        <th class="text-center">Quản lý</th>
    </tr>
    </thead>
    @foreach ($posts as $post)
    <tr>
        <td>
            <a href="{{ route('posts.show', $post->slug) }}" class="">{{ $post->slug }}</a>
        </td>
        <td>
            {{ $post->created_at }}
        </td>

        <td>
            {{ $post->state_label }}
        </td>

        <td class="text-center">
            <a class="btn {{ ($post->status == 'published') ? 'btn-info' : 'btn-default' }} btn-xs approve" value="{{ $post->id }}" id="admin-approve-{{ $post->id }}"><span class="glyphicon glyphicon-star"></span> {{ ($post->status == 'published') ? 'duyệt bài' : 'đóng bài' }}</a>
            <a class="btn btn-success btn-xs edit" value="{{ $post->id }}" id="admin-edit-{{ $post->id }}" data-toggle="modal" data-target="#admin-index-edit-post-model"><span class="glyphicon glyphicon-edit"></span> sửa bài</a>
            <a class="btn btn-danger btn-xs delete" value="{{ $post->id }}" id="admin-delete-{{ $post->id }}"><span class="glyphicon glyphicon-remove"></span> xóa bài</a>

            <input name="hidden-post-id" type="hidden">
            <input name="hidden-isRecommended-{{ $post->id }}" type="hidden" value="{{ $post->is_recommended == 1 ? true : false }}">
            <input name="hidden-title-{{ $post->id }}" type="hidden" value="{{ $post->title }}">
            <input name="hidden-description-{{ $post->id }}" type="hidden" value="{{ $post->description }}">
            <input name="hidden-state-{{ $post->id }}" type="hidden" value="{{ $post->state == 1 ? true : false }}">
            <input name="hidden-status-{{ $post->id }}" type="hidden" value="{{ $post->status }}">
            <input name="hidden-branch-{{ $post->id }}" type="hidden" value="{{ $post->branch }}">
            <input name="hidden-model-{{ $post->id }}" type="hidden" value="{{ $post->model }}">
            <input name="hidden-price-{{ $post->id }}" type="hidden" value="{{ $post->price }}">
        </td>

    </tr>
    @endforeach
</table>
{{ csrf_field() }}
<div class="text-center">
{!! $posts->render() !!}
</div>

@include('partials.ajaxAdminEditPost')
