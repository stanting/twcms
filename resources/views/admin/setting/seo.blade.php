@extends('layouts.admin')

@section('content')
<div class="m">
    <div class="p">
        <div class="cc">
            <form action="{{ route('admin.setting.seo.store') }}" method="POST">
                <div class="tb_t">SEO设置</div>
                <table class="tb">
                    <tr>
                        <th class="th">SEO标题</th>
                        <td class="col"><input name="seo_title" type="text" value="让建站变的更简单！" class="inp w1"></td>
                    </tr>
                    <tr>
                        <th class="th">SEO关键字</th>
                        <td class="col"><input name="seo_keywords" type="text" value="通王CMS,TWCMS" class="inp w1"></td>
                    </tr>
                    <tr>
                        <th class="th">SEO描述</th>
                        <td class="col"><textarea name="seo_description" class="inp w3">通王CMS，让建站变的更简单！</textarea></td>
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