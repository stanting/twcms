@extends('layouts.admin')

@section('content')
<div class="m">
    <div class="p">
        <div class="cc">
            <form action="{{ route('admin.setting.upload.store') }}" method="POST">
                <div class="tb_t">上传设置</div>
                <table class="tb">
                    <tr>
                        <th class="th">上传图片</th>
                        <td class="col">允许类型{$input[up_img_ext]} 最大限制{$input[up_img_max_size]}KB</td>
                    </tr>
                    <tr>
                        <th class="th">上传附件</th>
                        <td class="col">允许类型{$input[up_file_ext]} 最大限制{$input[up_file_max_size]}KB</td>
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