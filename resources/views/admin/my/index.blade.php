@extends('layouts.admin')

@section('content')
    <div class="m">
        <div class="p">
            <div class="cc cf" style="padding-top:0">
                <div id="homel" class="conthome">
                    <div class="sort">
                        <h1>常用功能</h1>
                        <dl class="sc cf" id="used">
                            @foreach ($used as $item)
                            <dd>
                                <a urlKey="{{ $item['url'] }}" title="{{ $item['name'] }}">
                                    <img src="{{ asset($item['img']) }}">{{ $item['name'] }}
                                </a>
                            </dd>
                            @endforeach
                        </dl>
                    </div>
                    <div class="sort">
                        <h1>我的信息</h1>
                        <ul class="sc">
                            <li><b>登录帐号</b>{$_user[username]}</li>
                            <li><b>内容条数</b>{$_user[contents]}</li>
                            <li><b>评论条数</b>{$_user[comments]}</li>
                            <li><b>登陆次数</b>{$_user[logins]}</li>
                            <li><b>本次登录</b>{$_user[logindate]}（{$_user[loginip]}）</li>
                            <li><b>上次登录</b>{$_user[lastdate]}（{$_user[lastip]}）</li>
                            <li><b>注册时间</b>{$_user[regdate]}（{$_user[regip]}）</li>
                            <li><b>浏览器核</b><span id="browser"></span></li>
                        </ul>
                    </div>
                </div>

                <div id="homer" class="conthome">
                    <div class="sort">
                        <h1>综合统计</h1>
                        <ul class="sc">
                            <li><b>分类总数</b>{$stat[category]}</li>
                            <li><b>文章内容</b>{$stat[article]}</li>
                            <li><b>文章评论</b>{$stat[article_comment]}</li>
                            <li><b>产品内容</b>{$stat[product]}</li>
                            <li><b>产品评论</b>{$stat[product_comment]}</li>
                            <li><b>图集内容</b>{$stat[photo]}</li>
                            <li><b>图集评论</b>{$stat[photo_comment]}</li>
                            <li><b>可用空间</b>{$stat[space]}</li>
                        </ul>
                    </div>
                    
                    <div class="sort">
                        <h1>服务器配置</h1>
                        <ul class="sc">
                            <li><b>操作系统</b>{{ $serverInfo['os'] }}</li>
                            <li><b>环境软件</b>{{ $serverInfo['software'] }}</li>
                            <li><b>MySQL</b>{{ $serverInfo['mysql'] }}</li>
                            <li><b>上传限制</b>{{ $serverInfo['filesize'] }}</li>
                            <li><b>执行限制</b>{{ $serverInfo['exectime'] }}秒</li>
                            <li><b>远程访问</b>{{ $serverInfo['url_fopen'] }}</li>
                            <li><b>其它支持</b>{{ $serverInfo['other'] }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(window).resize(setHomeWidth);

        $(function () {
            $("#used a").click(function () {
                parent.oneTab($(this).attr("urlKey"));
            }).attr("href", "javascript:;");

            setHomeWidth();
            getBrowser();

            setStyle("img:hover", ".2s ease-in-out 0s 3", "a_s", "rotate(0deg)", "rotate(-6deg)", "rotate(0deg)", "rotate(6deg)", "rotate(0deg)");
        });

        function setStyle(name, val, func, a, b, c, d, e) {
            var arr = ["webkit", "ms", "moz", "o"];
            var s = s2 = "";
            for (var v in arr) {
                s += "@-" + arr[v] + "-keyframes " + func + "{";
                s += "0%{-" + arr[v] + "-transform:" + a + "}";
                s += "25%{-" + arr[v] + "-transform:" + b + "}";
                s += "50%{-" + arr[v] + "-transform:" + c + "}";
                s += "75%{-" + arr[v] + "-transform:" + d + "}";
                s += "100%{-" + arr[v] + "-transform:" + e + "}";
                s += "}";
                s2 += "-" + arr[v] + "-animation:" + func + " " + val + ";"
            }
            $("head").append('<style type="text/css">' + s + name + '{' + s2 + '}</style>');
        }

        function setHomeWidth() {
            $("#homel,#homer").width(($(".cc").width() - 8) / 2);
        }

        function appInfo() {
            var browser = {
                msie: false, firefox: false, opera: false, safari: false,
                chrome: false, netscape: false, appname: '未知', version: ''
            },
                    userAgent = window.navigator.userAgent.toLowerCase();
            if (/(msie|firefox|opera|chrome|netscape)\D+(\d[\d.]*)/.test(userAgent)) {
                browser[RegExp.$1] = true;
                browser.appname = RegExp.$1;
                browser.version = RegExp.$2;
            } else if (/version\D+(\d[\d.]*).*safari/.test(userAgent)) {
                browser.safari = true;
                browser.appname = 'safari';
                browser.version = RegExp.$2;
            }
            return browser;
        }

        function getBrowser() {
            var myos = appInfo();
            $("#browser").html(myos.appname + " " + myos.version + (myos.msie && myos.version < 9 ? ' <strong style="color:red">【您的浏览器不支持圆角效果，建议使用IE9以上版本或chrome】</strong>' : ''));
        }
    </script>
@endsection