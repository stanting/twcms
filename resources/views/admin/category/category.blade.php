@extends('layouts.admin')

@section('content')
<style type="text/css">
    .tb{margin:5px auto}
    .tb .th div{width:96px}
    .tb .col label{padding-right:8px}
</style>

<div class="m">
    <div class="head">
        <dl>
            <input id="add" type="button" value="增加分类" class="but1" />
            <dd class="on">分类管理</dd>
        </dl>
    </div>

    <div class="p c2">
        <div class="cc" id="category_content">
            {inc:category_content.htm}
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    var models = {$models};
    load_event(); // 加载事件

// 默认无编辑器
    window.editor_init = function () {
        // 编辑器API
        window.editor_api = {
            // 单页内容
            page_content: {
                obj: $('#page_content'),
                get: function () {
                    return this.obj.val();
                },
                set: function (s) {
                    return this.obj.val(s);
                },
                focus: function () {
                    return this.obj.focus();
                }
            }
        }
    }

// 添加分类
    $("#add").click(function () {
        if ($(this).val() == "增加分类") {
            $(this).val("关闭窗口");

            // 加载会话框
            load_dialog();
            $("#twdialog_title span").html("增加分类");

            // 初始化表单
            var mid = $("#set_dialog").attr("_mid");
            var type = $("#set_dialog").attr("_type");
            var upid = $("#set_dialog").attr("_upid");

            $("#twdialog input[name='mid']").val([mid]);
            $("#twdialog input[name='type']").val([type]);
            setFormVal(mid, type);

            // 加载所属频道
            loadCategoryUpid(mid, upid);
        } else {
            remove_dialog();
        }
    });

// 鼠标放上去事件
    function load_event() {
        $(".cat_col").hover(
                function () {
                    $(this).css("background", "#FFB");

                    if ($(".more_but").length < 1) {
                        var cid = $(this).attr("cid");
                        var mid = $(this).attr("mid");
                        var url = $(this).attr("url");

                        var s = '<div class="more_but">';
                        s += '<a class="but2" href="javascript:edit(' + cid + ');">编辑</a>';
                        s += '<a class="but2" href="' + url + '" target="_blank">查看</a>';
                        s += '<a class="but2 del" href="javascript:del(' + cid + ');">删除</a>';
                        s += '</div>';

                        $(this).find(".cat_c_1").append(s);
                        $(this).find(".c_name").width($(this).find(".cat_c_1").width() - 160);
                    }
                },
                function () {
                    $(this).removeAttr("style");
                    $(this).find(".c_name").removeAttr("style");
                    $(".more_but").remove();
                }
        );

        // 快速修改排序
        $(".cat_c_3 input[name='orderby']").focusin(function () {
            $(this).attr("v", $(this).val());
        }).focusout(function () {
            var orderby = $(this).val();
            var old_orderby = $(this).attr("v");
            if (orderby == old_orderby)
                return;
            var cid = $(this).parent().parent().attr("cid");
            twAjax.post("index.php?u=category-edit_orderby-ajax-1", {cid: cid, orderby: orderby}, function (data) {
                var data = toJson(data);
                if (window.twExit)
                    return;
                if (data.err == 0)
                    getAllCate();
            });
        });
    }

// 加载对话框 (增加或编辑时使用)
    function load_dialog() {
        var H = Math.max(350, document.documentElement.clientHeight - 30);
        $.twDialog("remove");
        $.twDialog({content: $("#set_dialog").html(), resizable: true, open: true, modal: false, width: 900, height: H, minW: 700});

        // 增加关闭窗口事件
        $("#twdialog_title a,#twdialog_button .close").click(remove_dialog);

        // 改变分类模型
        $("#twdialog input[name='mid']").change(function () {
            var mid = $(this).val();
            setFormVal(mid, $("#twdialog").attr("type"));

            // 加载所属频道
            loadCategoryUpid(mid);
        });

        // 改变分类类型
        $("#twdialog input[name='type']").change(function () {
            setFormVal($("#twdialog").attr("mid"), $(this).val());
        });

        // 触发提交 (添加 & 编辑)
        $("#twdialog_button>.ok").click(function () {
            $("#twdialog form").submit();
        });

        // 拦截表单提交
        twAjax.submit("#twdialog form", function (data) {
            twAjax.alert(data);
            if (window.twData.err == 0) {
                // 增加时记录状态
                var cid = $("#twdialog input[name='cid']").val();
                if (!cid) {
                    var fields = $("#twdialog input[name='mid'], #twdialog input[name='type'], #twdialog input[name='upid']").serializeArray();
                    $.each(fields, function (i, field) {
                        if (field.name == "mid") {
                            $("#set_dialog").attr("_mid", field.value);
                        } else if (field.name == "type") {
                            $("#set_dialog").attr("_type", field.value);
                        } else if (field.name == "upid") {
                            $("#set_dialog").attr("_upid", field.value);
                        }
                    });
                }

                remove_dialog();
                getAllCate();
            }
        });
    }

// 移除编辑器
    function remove_dialog() {
        $.twDialog("remove");
        $("#add").val("增加分类");
    }

// 设置表单内的值
    function setFormVal(mid, type) {
        $("#twdialog").attr("mid", mid);
        $("#twdialog").attr("type", type);

        if (mid == 1) {
            $("#i_type").hide();
            $("#i_page_content").show();
            $("#i_show_tpl").hide();
            $("#i_upid>th").html("上级分类");

            // 单页时把类型设置为 0
            $("#twdialog input[name='type']").val([0]);
            $("#twdialog").attr("type", 0);

            editor_init();
        } else {
            $("#i_type").show();
            $("#i_page_content").hide();
            $("#i_show_tpl").show();
            $("#i_upid>th").html("所属频道");
        }
        $("#i_cate_tpl>th").html(mid == 1 ? "单页模板" : (type == 1 ? "频道模板" : "列表模板"));

        // 默认模板设置
        var edit_mid = $("#twdialog").attr("edit_mid");
        var edit_type = $("#twdialog").attr("edit_type");
        if (!!edit_mid && edit_mid == mid && edit_type == type) {
            $("#cate_tpl").val($("#cate_tpl").attr("v"));
            $("#show_tpl").val($("#show_tpl").attr("v"));
        } else {
            var k = "models-mid-" + mid;
            $("#cate_tpl").val(mid != 1 && type == 1 ? models[k]["index_tpl"] : models[k]["cate_tpl"]);
            $("#show_tpl").val(models[k]["show_tpl"]);
        }
    }

// 编辑分类
    function edit(cid) {
        twAjax.postd("index.php?u=category-get_category_json-ajax-1", {cid: cid}, function (data) {
            data = toJson(data);
            if (window.twEixt)
                return;
            twAjax.remove();

            // 加载会话框
            load_dialog();
            $("#twdialog_title span").html("编辑分类");

            // 遍历设置表单值
            for (var v in data) {
                $("#twdialog [name='" + v + "']").val([data[v]]);
            }

            // 如果分类已发布了内容或有下级分类就不允许改变模型和类型
            if (data.count > 0 || data.son_cate) {
                $("#twdialog input[name='mid']").each(function () {
                    if ($(this).val() != data.mid) {
                        $(this).attr("disabled", "disabled");
                    }
                });

                $("#twdialog input[name='type']").each(function () {
                    if ($(this).val() != data.type) {
                        $(this).attr("disabled", "disabled");
                    }
                });
            }

            // 记录模板设置
            $("#cate_tpl").attr("v", data.cate_tpl);
            $("#show_tpl").attr("v", data.show_tpl);

            // 设置表单内的值
            $("#twdialog").attr("edit_mid", data.mid);
            $("#twdialog").attr("edit_type", data.type);
            setFormVal(data.mid, data.type);

            // 加载所属频道
            loadCategoryUpid(data.mid, data.upid, data.cid);
        });
    }

// 删除分类
    function del(cid) {
        twAjax.confirm("删除不可恢复，确定删除？", function () {
            twAjax.postd("index.php?u=category-del-ajax-1", {cid: cid}, function (data) {
                twAjax.alert(data);
                if (window.twData.err == 0)
                    $(".category dl[cid='" + cid + "']").remove();
            });
        });
    }

// 加载所属频道
    function loadCategoryUpid(mid, upid, noid) {
        twAjax.get("index.php?u=category-get_category_upid-ajax-1-mid-" + mid + "-upid-" + Math.max(0, upid) + "-noid-" + Math.max(0, noid) + "&r=" + time(), function (data) {
            data = toJson(data);
            if (window.twEixt)
                return;
            $("#upid").html(data.upid);
        });
    }

// 获取所有分类列表
    function getAllCate() {
        setTimeout(function () {
            twAjax.get("index.php?u=category-get_category_content&r=" + time(), function (html) {
                $("#category_content").html(html);
                load_event();
            });
        }, 500);
    }
</script>
@endsection