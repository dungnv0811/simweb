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
            <a href="{{ route('posts.show', $post->id) }}" class=""><i class="fa fa-shopping-cart"></i>{{ $post->slug }}</a>
        </td>
        <td>
            {{ $post->created_at }}
        </td>

        <td>
            assasasa
        </td>

        <td class="text-center">
            <a class="btn {{ ($post->status == 'published') ? 'btn-info' : 'btn-default' }} btn-xs approve" value="{{ $post->id }}" id="admin-approve-{{ $post->id }}"><span class="glyphicon glyphicon-star"></span> {{ ($post->status == 'published') ? 'duyệt bài' : 'đóng bài' }}</a>
            <a class="btn btn-success btn-xs edit" value="{{ $post->id }}" id="admin-delete-{{ $post->id }}"><span class="glyphicon glyphicon-edit"></span> sửa bài</a>
            <a class="btn btn-danger btn-xs delete" value="{{ $post->id }}" id="admin-delete-{{ $post->id }}"><span class="glyphicon glyphicon-remove"></span> xóa bài</a>
        </td>

    </tr>
    @endforeach
</table>
{{ csrf_field() }}
<div class="text-center">
{!! $posts->render() !!}
</div>
