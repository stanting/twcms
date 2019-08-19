@extends('layouts.admin')

@section('content')
<div class="m">
    <div class="p">
        <div class="cc">
            <form action="{{ route('admin.my.password.store') }}" method="POST">
                <div class="tb_t">修改密码</div>
                <table class="tb">
                    <tr>
                        <th class="th">原密码</th>
                        <td class="col"><input name="oldpw" type="password" class="inp w1" autocomplete /></td>
                    </tr>
                    <tr>
                        <th class="th">新密码</th>
                        <td class="col"><input name="newpw" type="password" class="inp w1" autocomplete /></td>
                    </tr>
                    <tr>
                        <th class="th">确认密码</th>
                        <td class="col"><input name="newpw_confirmation" type="password" class="inp w1" autocomplete /></td>
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
    twAjax.submit("form:first", function (data) {
        twAjax.alert(data);
        if (window.twData.err == 0)
            setTimeout("window.location.reload()", 1000);
    });
</script>
@endsection