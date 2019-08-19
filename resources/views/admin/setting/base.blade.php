@extends('layouts.admin')

@section('content')
<div class="m">
    <div class="p">
        <div class="cc">
            <form action="{{ route('admin.my.password.store') }}" method="POST">
                <div class="tb_t">基本设置</div>
                <table class="tb">
                    <tr>
                        <th class="th">站点标题</th>
                        <td class="col"><input name="webname" type="text" value="{{ config('app.name') }}" class="inp w1"></td>
                    </tr>
                    <tr>
                        <th class="th">站点域名</th>
                        <td class="col"><input name="webdomain" type="text" value="{{ config('app.url') }}" class="inp w1"></td>
                    </tr>
                    <tr>
                        <th class="th">所在目录</th>
                        <td class="col"><input name="webdir" type="text" value="/" class="inp w1"></td>
                    </tr>
                    <tr>
                        <th class="th">邮箱</th>
                        <td class="col"><input name="webmail" type="text" value="{{ config('app.email') }}" class="inp w1"></td>
                    </tr>
                    <tr>
                        <th class="th">统计代码</th>
                        <td class="col"><textarea name="tongji" class="inp w3"></textarea></td>
                    </tr>
                    <tr>
                        <th class="th">备案号</th>
                        <td class="col"><input name="beian" type="text" value="{{ config('app.beian') }}" class="inp w1"></td>
                    </tr>
                    <tr>
                        <th class="th">关闭全站评论</th>
                        <td class="col"><input type="checkbox" name="dis_comment" value="1" {if:$input['dis_comment']} checked="checked"{/if}title="关闭全站的评论功能"></td>
                    </tr>
                </table>
                <div class="tb_b"><input type="submit" value="&#20445;&#23384;" class="but1" /></div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    twAjax.submit("form:first");
</script>
@endsection