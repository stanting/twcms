@extends('layouts.admin')

@section('content')
<style type="text/css">
    .tb2 .li .col{border-bottom:1px solid #D0E6EC}
    .tb2 .li i{margin-right:15px;color:#077AC7}
</style>
<div class="m">
    <div class="head">
        <dl>
            <dt style="display:inline;float:left;margin-right:8px">
                <select name="mid" id="mid">
                    {loop:$mod_name $v $k}<option value="{$k}"{if:$mid == $k} selected="selected"{/if}>{$v}评论</option>{/loop}
                </select>
            </dt>
        </dl>
    </div>
    <div class="p c2">
        <div class="cc">
            {if:empty($comment_arr)}<div class="sky warning bnote"><i></i><b>暂无评论</b></div>{else}
            <table class="tb2">
                <tr class="tit">
                    <th class="th" width="25"><input type="checkbox" id="check_all"></th>
                    <th class="th" width="100">作者</th>
                    <th class="th">评论</th>
                    <th class="th" width="100">操作</th>
                </tr>

                {loop:$comment_arr $v}
                <tr class="li">
                    <td class="col"><input type="checkbox" name="chk_row" _id="{$v[id]}" _commentid="{$v[commentid]}"></td>
                    <td class="col">{$v[author]}<br>({$v[ip]})</td>
                    <td class="col">发表于：<i>{$v[date]}</i> 标题：<a href="{$v[url]}" target="_blank">{$v[title]}</a><br>{$v[content]}</td>
                    <td class="col"><a class="but3" href="javascript:edit({$v[commentid]});">编辑</a> <a class="but3 del" href="javascript:del({$v[id]},{$v[commentid]});">删除</a></td>
                </tr>
                {/loop}
            </table>
            <div class="page cf"><span>共 <font color="red">{$total}</font> 条</span>{$pages}</div>
            {/if}
        </div>
    </div>
</div>
@endsection

@section('js')
<script id="edit_comment" type="text/html">
    <table class="tb">
        <tr>
            <th class="th">昵称</th>
            <td class="col"><input id="c_author" name="author" type="text" class="inp w1" /></td>
        </tr>
        <tr>
            <th class="th">评论</th>
            <td class="col"><textarea id="c_content" name="content" class="inp w3" style="width:98%"></textarea></td>
        </tr>
    </table>
</script>

<script type="text/javascript">
    var _mid = $("#mid").val();
    $("#mid").change(function () {
        var mid = $(this).val();
        location.href = 'index.php?u=comment-index-mid-' + mid;
    });

//全选
    $("#check_all").click(function () {
        var bool = $(this)[0].checked;
        var len = $("input[name='chk_row']").length;
        for (var i = 0; i < len; i++) {
            $("input[name='chk_row']").eq(i)[0].checked = bool;
        }
        bool ? buttonDis() : $("#batch_del").remove();
    });

//是否显示删除按钮
    $("input[name='chk_row']").click(function () {
        var len = $("input[name='chk_row']:checked").length;
        len ? buttonDis() : $("#batch_del").remove();
    });

//显示删除按钮
    function buttonDis() {
        if (!$("#batch_del").length)
            $(".head>dl").append('<input id="batch_del" onclick="batch_del()" type="button" value="批量删除" class="but1" />');
    }

//批量删除
    function batch_del() {
        twAjax.confirm("删除不可恢复，确定删除？", function () {
            var id_arr = {};
            var len = $("input[name='chk_row']").length;
            for (var i = 0; i < len; i++) {
                var obj = $("input[name='chk_row']").eq(i);
                if (obj[0].checked) {
                    id_arr[i] = [obj.attr("_id"), obj.attr("_commentid")];
                }
            }
            twAjax.postd("index.php?u=comment-batch_del-ajax-1", {"mid": _mid, "id_arr": id_arr}, function (data) {
                twAjax.alert(data);
                if (window.twData.err == 0)
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
            });
        });
    }

//编辑
    function edit(commentid) {
        $.twDialog({content: $("#edit_comment").html(), resizable: true, open: true, modal: true, width: 900, height: 280, minW: 500, minH: 280});

        //读取
        twAjax.postd("index.php?u=comment-get_json-ajax-1", {"mid": _mid, "commentid": commentid}, function (data) {
            var json = toJson(data);
            $("#c_author").val(json.author);
            $("#c_content").val(json.content);
            twAjax.remove();
        });

        //提交
        $("#twdialog_button>.ok").click(function () {
            var author = $("#c_author").val();
            var content = $("#c_content").val();
            twAjax.postd("index.php?u=comment-edit-ajax-1", {"mid": _mid, "commentid": commentid, "author": author, "content": content}, function (data) {
                twAjax.alert(data);
                $.twDialog("remove");
                if (window.twData.err == 0)
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
            });
        });
    }

//删除
    function del(id, commentid) {
        twAjax.confirm("删除不可恢复，确定删除？", function () {
            twAjax.postd("index.php?u=comment-del-ajax-1", {"mid": _mid, "id": id, "commentid": commentid}, function (data) {
                twAjax.alert(data);
                if (window.twData.err == 0)
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
            });
        });
    }
</script>
@endsection