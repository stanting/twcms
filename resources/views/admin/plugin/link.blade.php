@extends('layouts.admin')

@section('content')
<style type="text/css">
    #link_tit{background:#E3F1F4;border-bottom:1px solid #B4DBF2}
    #link_tit ul li{padding-left:8px;height:32px;line-height:32px;font-weight:bold}
    #link_cont{position:relative;cursor:move}
    #link_cont ul li{height:32px;line-height:32px;padding:6px 0 0 8px}
    #link_cont ul li .inp{width:85%;vertical-align:top}
    #link_cont ul:hover{background:#FFFFBB}
    .link_l{float:left;width:25%}
    .link_c{float:left;width:55%}
    .link_r{float:left;width:15%}
</style>

<div class="m">
    <div class="head">
        <dl>
            <input id="ready" onclick="link_ready()" type="button" value="增加" class="but1" />
            <dd class="on">{$_title}</dd>
        </dl>
    </div>

    <div class="p c2">
        <div class="cc">
            <div id="link_tit">
                <ul class="cf">
                    <li class="link_l">网站名称</li>
                    <li class="link_c">网站 URL</li>
                    <li class="link_r">操作</li>
                </ul>
            </div>
            <div id="link_cont">
                {loop:$links $v $k}
                <ul class="cf" key="{$k}">
                    <li class="link_l"><input type="text" onfocus="link_focus(this)" onblur="link_blur(this)" onchange="link_change(this)" class="inp name" value="{$v[name]}"></li>
                    <li class="link_c"><input type="text" onfocus="link_focus(this)" onblur="link_blur(this)" onchange="link_change(this)" class="inp url" value="{$v[url]}"></li>
                    <li class="link_r"><a class="but3" onclick="link_del(this)" href="javascript:;">删除</a></li>
                </ul>
                {/loop}
            </div>
            {if:empty($links)}<div class="sky warning bnote" style="margin-top:8px"><i></i><b>暂无链接</b></div>{/if}
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
//拖拽插件
    $.fn.kpdragsort = function (options) {
        var container = this;

        $(container).children().off("mousedown").mousedown(function (e) {
            if (e.which != 1 || $(e.target).is("input, textarea, a") || window.kp_only)
                return; // 排除非左击和其他元素
            e.preventDefault(); // 阻止选中文本

            var x = e.pageX;
            var y = e.pageY;
            var _this = $(this); // 点击选中块
            var w = _this.width();
            var h = _this.height();
            var w2 = w / 2;
            var h2 = h / 2;
            var p = _this.position();
            var left = p.left;
            var top = p.top;
            var sTop = $(".p:first").scrollTop();
            window.kp_only = true;

            // 添加虚线框
            _this.before('<div id="kp_widget_holder"></div>');
            var wid = $("#kp_widget_holder");
            wid.css({"border": "2px dashed #ccc", "height": _this.outerHeight(true) - 4});

            // 保持原来的宽高
            _this.css({"width": w, "height": h, "position": "absolute", opacity: 0.8, "z-index": 999, "left": left, "top": top});

            // 绑定mousemove事件
            $(document).mousemove(function (e) {
                e.preventDefault();

                // 移动选中块
                var l = left + e.pageX - x;
                var t = top + ($(".p:first").scrollTop() - sTop) + e.pageY - y;
                _this.css({"left": l, "top": t});

                // 选中块的中心坐标
                var ml = l + w2;
                var mt = t + h2;

                // 遍历所有块的坐标
                $(container).children().not(_this).not(wid).each(function (i) {
                    var obj = $(this);
                    var p = obj.position();
                    var a1 = p.left;
                    var a2 = p.left + obj.width();
                    var a3 = p.top;
                    var a4 = p.top + obj.height();

                    // 移动虚线框
                    if (a1 < ml && ml < a2 && a3 < mt && mt < a4) {
                        if (!obj.next("#kp_widget_holder").length) {
                            wid.insertAfter(this);
                        } else {
                            wid.insertBefore(this);
                        }
                        return;
                    }
                });
            });

            // 绑定mouseup事件
            var _mouseup = function () {
                $(document).off('mouseup').off('mousemove');

                // 拖拽回位，并删除虚线框
                var p = wid.position();
                _this.animate({"left": p.left, "top": p.top}, 100, function () {
                    _this.removeAttr("style");
                    wid.replaceWith(_this);

                    check_sort(); // 检查排序是否已修改

                    window.kp_only = null;
                    if (parent)
                        parent.document.onmouseup = null;
                });
            };
            $(document).mouseup(_mouseup);
            if (parent)
                parent.document.onmouseup = _mouseup;
        });
    }

//获取一列
    function get_line(name, url, isDel, key) {
        var s = '<ul class="cf"' + (key ? ' key="' + key + '"' : '') + '>';
        s += '<li class="link_l"><input type="text" onfocus="link_focus(this)" onblur="link_blur(this)" onchange="link_change(this)" class="inp name" value="' + (!name ? '' : name) + '"></li>';
        s += '<li class="link_c"><input type="text" onfocus="link_focus(this)" onblur="link_blur(this)" onchange="link_change(this)" class="inp url" value="' + (!url ? 'http://' : url) + '"></li>';
        s += '<li class="link_r">';
        s += isDel ? '<a class="but3" onclick="link_del(this)" href="javascript:;">删除</a>' : '<a class="but3" onclick="link_set(this)" href="javascript:;">确定</a> &nbsp; <a class="but3" onclick="link_cancel(this)" href="javascript:;">取消</a>';
        s += '</li></ul>';
        return s;
    }

//获得焦点
    function link_focus(obj) {
        var o = $(obj).parent().parent();
        o.find(".inp").each(function () {
            if (!$(this).attr("old"))
                $(this).attr("old", $(this).val());
        });
        o.find(".link_r").html('<a class="but3" onclick="link_set(this)" href="javascript:;">确定</a> &nbsp; <a class="but3" onclick="link_reducing(this)" href="javascript:;">取消</a>');
    }

//失去焦点
    function link_blur(obj) {
        var o = $(obj).parent().parent();
        if (!o.attr("change")) {
            o.find(".link_r").html('<a class="but3" onclick="link_del(this)" href="javascript:;">删除</a>');
        }
    }

//内容改变
    function link_change(obj) {
        $(obj).parent().parent().attr("change", 1);
    }

//增加一列
    function link_ready() {
        $("#link_cont").prepend(get_line());
    }

//取消一列
    function link_cancel(obj) {
        $(obj).parent().parent().slideUp(500, function () {
            $(this).remove();
        });
    }

//还原修改
    function link_reducing(obj) {
        var o = $(obj).parent().parent();
        o.find(".inp").each(function () {
            $(this).val($(this).attr("old"));
        });
        o.removeAttr("change");
    }

//增加/编辑链接
    function link_set(obj) {
        var o = $(obj).parent().parent();
        var name = o.find(".name").val();
        var url = o.find(".url").val();
        var key = o.attr("key");
        twAjax.postd("index.php?u=links-set-ajax-1", {"name": name, "url": url, "key": key}, function (data) {
            twAjax.alert(data);
            $(".ajaxtips u").click(function () {
                if (twData.name != '')
                    o.find("." + twData.name).focus();
            });
            if (window.twData.err == 0) {
                if ($(".sky").length > 0)
                    $(".sky").remove();
                // key 有值为编辑
                if (key) {
                    o.removeAttr("change");
                    o.find(".name").attr("old", name);
                    o.find(".url").attr("old", url);
                    o.find(".link_r").html('<a class="but3" onclick="link_del(this)" href="javascript:;">删除</a>');
                } else {
                    o.remove();
                    $("#link_cont").append(get_line(name, url, true, twData.name));
                }
                $("#link_cont").kpdragsort();
            }
        });
    }

//删除链接
    function link_del(obj) {
        var o = $(obj).parent().parent();
        var name = o.find(".name").val();
        var key = o.attr("key");
        twAjax.confirm("删除不可恢复，确定删除“<font color='red'>" + name + "</font>”？", function () {
            twAjax.postd("index.php?u=links-del-ajax-1", {"key": key}, function (data) {
                twAjax.alert(data);
                if (window.twData.err == 0)
                    o.remove();
            });
        });
    }

//修改链接排序
    function link_sort() {
        var keys = [];
        $("#link_cont>ul").each(function (i) {
            keys[i] = $(this).attr("key");
        });
        twAjax.postd("index.php?u=links-sort-ajax-1", {"keys": keys}, function (data) {
            twAjax.alert(data);
            if (window.twData.err == 0)
                setTimeout(function () {
                    window.location.reload();
                }, 1000);
        });
    }

//检查排序是否已修改
    function check_sort() {
        var len = $("#link_cont>ul").length;
        var but = $("#link_sort").length;
        for (var i = 0; i < len; i++) {
            if (keys[i] !== $("#link_cont>ul").eq(i).attr("key")) {
                if (!but)
                    $(".head>dl").append('<input id="link_sort" onclick="link_sort()" type="button" value="保存排序" class="but1" />');
                return;
            }
        }
        if (but)
            $("#link_sort").remove();
    }

    var keys = [];
    $("#link_cont>ul").each(function (i) {
        keys[i] = $(this).attr("key");
    });
    $("#link_cont").kpdragsort();
</script>
@endsection