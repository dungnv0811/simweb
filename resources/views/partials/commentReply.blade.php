<div class="response-area" id="post-comment-index-list">
    <h2>{{ $comments->count() }} Bình luận</h2>
    <ul class="media-list">
        @foreach($comments as $comment)
        <li class="media col-md-12">

            <a class="pull-left" href="#">
                <img class="media-object" src="{{url('/images/home/default-avatar.png')}}" width="64px">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{ $comment->user->name }}</li>
                    <li><i class="fa fa-calendar"></i> {{ Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}</li>
                </ul>
                <p>{{ $comment->body }}</p>
            </div>
        </li>
        @endforeach
    </ul>
</div><!--/Response-area-->
