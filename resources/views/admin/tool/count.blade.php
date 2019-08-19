@extends('layouts.admin')

@section('content')
<div class="m">
    <div class="p">
        <div class="cc">
            <div class="tb_t">重新统计</div>
            <ul class="marginbot">
                <li><label><input type="checkbox" checked="checked" id="re_cate"> <span title="重新统计分类的内容数量">分类内容数量</span></label></li>
                <li><label><input type="checkbox" checked="checked" id="re_table"> <span title="重新统计数据表的 count max 值">综合统计</span></label></li>
            </ul>
            <div class="tb_b" style="padding-left:0"><input type="submit" value="确定" class="but1" /></div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(".but1").click(function () {
        var v1 = $("#re_cate")[0].checked ? 1 : 0;
        var v2 = $("#re_table")[0].checked ? 1 : 0;
        twAjax.postd("index.php?u=tool-rebuild-ajax-1", {"re_cate": v1, "re_table": v2}, function (data) {
            twAjax.alert(data);
        });
    });
</script>
@endsection