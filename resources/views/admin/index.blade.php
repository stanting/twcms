<!DOCTYPE html>
<head>
    <title>{{ config('app.name') }} 后台管理</title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link href="{{ asset('admin-static/css/admin.css') }}" type="text/css" rel="stylesheet" />
</head>

<body scroll="no">
    <div class="acp">
        <div id="box_opt"><a id="ifr_refresh" title="刷新" href="">刷新</a> <a id="full_screen" title="全屏" href="">全屏</a></div>
        <div class="top">
            <div class="logo"><a href="{{ route('admin.index') }}"><img src="{{ asset('admin-static/img/logo.jpg') }}" /></a></div>
            <div class="nav">
                <ul>
                    @foreach($nav['menu'] as $key => $name)
                    <li pKey="{{ $key }}" tabindex="0" role="link">
                        <b>{{ $name }}</b>
                        <dl>
                            @foreach($nav['child'][$key] as $link => $title)
                            <dd urlKey="{{ $link }}" tabindex="0" role="link">{{ $title }}</dd>
                            @endforeach
                            <dt></dt>
                        </dl>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="uinfo">
                <p>您好, {{ Auth::user()->name }} 
                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         [退出]
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </p>
                <p class="ilk"><a href="{{ route('index') }}" target="_blank" title="网站首页">网站首页</a></p>
            </div>
        </div>
        <div class="unber">
            <div class="left">
                <h1 id="menutit"></h1>
                <dl id="menu"></dl>
            </div>
            <div class="right">
                <div id="closeer" title="关闭其它标签页"></div>
                <div id="leftbtn" title="向上"></div>
                <div id="rightbtn" title="向下"></div>
                <div id="adder" title="新标签页"></div>
                <div id="box_tab"><ul></ul></div>
                <div id="box_place"></div>
                <div id="box_frame"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin-static/js/admin.js') }}" type="text/javascript"></script>
</body>
</html>