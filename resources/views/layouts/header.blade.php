<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +84 905 606 289</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> dungnv.itdn@gmail.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="https://www.facebook.com/dungnv.itdn"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="{{ url('/') }}"><img src={{url('/images/home/logo.png')}} alt="Trang chủ"/></a>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{ url('/') }}"><i class="fa fa-home"></i> Trang chủ</a></li>
                            @if (Auth::guest())
                                <li><a href="{{ url('/login') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <li><a href="{{ url('/register') }}"><i class="fa fa-lock"></i> Đăng kí</a></li>
                            @else
                                @can('isAdmin')
                                    <li><a href="{{ route('admin.index') }}"><i class="fa fa-tasks"></i>Quản
                                            lý</a></li>
                                @endcan
                                <li><a href="{{ route('users.show', Auth::user()->email) }}"><i class="fa fa-user"></i> Cá
                                        nhân</a></li>
                                <li><a href="{{ url('/posts/create') }}"><i class="fa fa-plus-square"></i> Đăng tin</a>
                                </li>
                                <li><a><i class="fa fa-lock"></i> {{ Auth::user()->name }}</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Đăng xuất</a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

</header><!--/header-->
