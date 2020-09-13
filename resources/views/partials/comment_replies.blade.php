<div class="response-area">
    <h2>3 RESPONSES</h2>
    <ul class="media-list">
        @foreach($comments as $comment)
        <li class="media col-md-12">

            <a class="pull-left" href="#">
                <img class="media-object" src="images/blog/man-two.jpg" alt="">
            </a>
            <div class="media-body">
                <ul class="sinlge-post-meta">
                    <li><i class="fa fa-user"></i>{{ $comment->user->name }}</li>
                    <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                    <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                </ul>
                <p>{{ $comment->body }}</p>
                <a class="btn btn-primary" href=""><i class="fa fa-reply"></i>Replay</a>
            </div>
        </li>
        @endforeach
    </ul>
</div><!--/Response-area-->
