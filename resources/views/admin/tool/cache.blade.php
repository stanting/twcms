@extends('layouts.admin')

@section('content')
<div class="m">
    <div class="p">
        <div class="cc">
            <div class="tb_t">清除缓存</div>
            <ul class="marginbot">
                <li><label><input type="checkbox" checked="checked" id="dbcache"> <span title="清空 runtime 数据表">数据库缓存</span></label></li>
                <li><label><input type="checkbox" checked="checked" id="filecache"> <span title="删除 runtime 目录中的文件缓存">文件缓存</span></label></li>
            </ul>
            <div class="tb_b" style="padding-left:0"><input type="submit" value="确定" class="but1" /></div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(".but1").click(function () {
        var v1 = $("#dbcache")[0].checked ? 1 : 0;
        var v2 = $("#filecache")[0].checked ? 1 : 0;
        twAjax.postd("index.php?u=tool-index-ajax-1", {"dbcache": v1, "filecache": v2}, function (data) {
            twAjax.alert(data);
        });
    });
</script>
@endsection