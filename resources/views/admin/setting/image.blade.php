@extends('layouts.admin')

@section('content')
<div class="m">
    <div class="p">
        <div class="cc">
            <form action="index.php?u=setting-image-ajax-1" method="post">
                <div class="tb_t">缩略图设置</div>
                <table class="tb">
                    <tr>
                        <th class="th">文章缩略图</th>
                        <td class="col">{$input[thumb_article_w]} X {$input[thumb_article_h]}</td>
                    </tr>
                    <tr>
                        <th class="th">产品缩略图</th>
                        <td class="col">{$input[thumb_product_w]} X {$input[thumb_product_h]}</td>
                    </tr>
                    <tr>
                        <th class="th">图集缩略图</th>
                        <td class="col">{$input[thumb_photo_w]} X {$input[thumb_photo_h]}</td>
                    </tr>
                    <tr>
                        <th class="th">裁剪方式</th>
                        <td class="col">{$input[thumb_type]}</td>
                    </tr>
                    <tr>
                        <th class="th">缩略图质量</th>
                        <td class="col">{$input[thumb_quality]}</td>
                    </tr>
                </table>

                <div class="tb_t">水印设置</div>
                <table class="tb">
                    <tr>
                        <th class="th">水印的位置</th>
                        <td class="col">
                            <table style="width:200px">
                                <tr>
                                    <td colspan="2"><input class="radio" type="radio" name="watermark_pos" value="0"{if:$cfg['watermark_pos']==0} checked=""{/if}> 关闭</td>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="10"{if:$cfg['watermark_pos']==10} checked=""{/if}> 随机</td>
                                </tr>
                                <tr>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="1"{if:$cfg['watermark_pos']==1} checked=""{/if}> #1</td>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="2"{if:$cfg['watermark_pos']==2} checked=""{/if}> #2</td>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="3"{if:$cfg['watermark_pos']==3} checked=""{/if}> #3</td>
                                </tr>
                                <tr>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="4"{if:$cfg['watermark_pos']==4} checked=""{/if}> #4</td>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="5"{if:$cfg['watermark_pos']==5} checked=""{/if}> #5</td>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="6"{if:$cfg['watermark_pos']==6} checked=""{/if}> #6</td>
                                </tr>
                                <tr>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="7"{if:$cfg['watermark_pos']==7} checked=""{/if}> #7</td>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="8"{if:$cfg['watermark_pos']==8} checked=""{/if}> #8</td>
                                    <td><input class="radio" type="radio" name="watermark_pos" value="9"{if:$cfg['watermark_pos']==9} checked=""{/if}> #9</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <th class="th">水印透明度</th>
                        <td class="col">{$input[watermark_pct]}</td>
                    </tr>
                    <tr>
                        <th class="th">水印的路径</th>
                        <td class="col">可替换 <font color="BD0A01">static/img/watermark.png</font> 文件以实现您自己的水印效果</td>
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