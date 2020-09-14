<div class="register-req text-center">
    <p>Quản lý bài đăng</p>
</div><!--/register-req-->
<table class="table table-condensed">
    <thead class="">
    <tr>
        <td class="">Tên bài</td>
        <td class="">Quantity</td>
        <td class="">Total</td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($posts as $post)
        <tr>
            <td>
                <a href="{{ route('posts.show', $post->id) }}" class=""><i class="fa fa-shopping-cart"></i>{{ $post->slug }}</a>
            </td>
            <td>
                <div class="">
                    <a class="" href=""> + </a>
                    <input class="" type="text" name="quantity" value="1" autocomplete="off" size="2">
                    <a class="" href=""> - </a>
                </div>
            </td>
            <td>
                <p class="">$59</p>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-xs delete" id="{{ $post->id }}">Delete</button>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
{{ csrf_field() }}
{!! $posts->render() !!}
