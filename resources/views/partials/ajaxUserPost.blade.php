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
            {{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
        </td>

        <td>
        </td>

        <td class="text-center">
            <a class="btn btn-danger btn-xs delete" value="{{ $post->id }}" id="user-show-delete-{{ $post->id }}"><span class="glyphicon glyphicon-remove"></span> Xóa bài</a>
        </td>

    </tr>
    @endforeach
</table>
{{ csrf_field() }}
<div class="text-center">
    {!! $posts->render() !!}
</div>
