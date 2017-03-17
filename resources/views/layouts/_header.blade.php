<header class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target="#bs-navbar" aria-controls="bs-navbar" aria-expanded="false">
                <span class="sr-only">导航切换</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="brand-logo" href="/" class="navbar-brand">Oriidea</a>
        </div>

        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{ route('about') }}">About</a>
                </li>
                <li>
                    <a href="{{ route('help') }}">Help</a>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                @if (Auth::check())
                <li class="dropdown">
                    <a id="userDropdown" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li>
                            <a href="{{ route('users.show', Auth::user()->id) }}">个人中心</a>
                        </li>
                        <li>
                            <a href="#">编辑资料</a>
                        </li>
                        <li>
                            <a id="logout" href="#">
                                <form id="formLogout" action="{{ route('logout') }}" method="post">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}
                                  <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                                </form>
                            </a>
                        </li>
                    </ul>
                </li>

                @else
                <li>
                    <a href="{{ route('signup') }}">注册</a>
                </li>
                <li>
                    <a href="{{ route('login') }}">登录</a>
                </li>
                @endif

            </ul>
        </nav>
        <!-- bs-navbar  **end -->
    </div>
</header>
<!-- header **end -->
