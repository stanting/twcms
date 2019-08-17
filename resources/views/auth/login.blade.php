<!DOCTYPE html>
<html>
    <head>
        <title>{{ config('app.name') }} 后台登录</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8" />
        <script type="text/javascript">
            if (self.parent.frames.length != 0)
                self.parent.location = document.location;
        </script>
        <link href="{{ asset('admin-static/css/login.css') }}" type="text/css" rel="stylesheet" />
    </head>

    <body>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            
            <dl id="lgn">
                <dt><a href="../" title="返回首页"></a></dt>
                <dd><label>帐号</label><input type="text" name="name" class="int" /></dd>
                <dd><label>密码</label><input type="password" name="password" class="int" /></dd>
                <dt><input type="submit" value="登录" id="btn" /></dt>
            </dl>
        </form>
        
        <script src="{{ asset('js/jquery.js') }}" type="text/javascript"></script>
        <script type="text/javascript">
            var t = ($(document).height() - $("#lgn").height()) / 2;
            $("#lgn").animate({top: t + 10}, 'slow').animate({top: t - 10}, 'fast').animate({top: t}, 'fast');
            $(window).resize(function () {
                $("#lgn").offset({top: ($(document).height() - $("#lgn").height()) / 2});
            });
            $("label").click(function () {
                $(this).parent().children(".int").focus();
                $(this).hide();
            });
            $(".int").focusin(function () {
                $(this).parent().children("label").hide();
                $(this).parent().children("div").remove();
            }).focusout(function () {
                if ($(this).val().length == 0)
                    $(this).parent().children("label").show();
            });
            $("form:first").submit(function () {
                $("#btn").attr("disabled", "disabled").addClass("on").val("登录中...");
                setTimeout(function () {
                    $("#btn").removeAttr("disabled").removeAttr("class").val("登录");
                }, 2000);

                $.post($(this).attr("action"), $(this).serialize(), function (data) {
                    data = toJson(data);
                    $(".tips").remove();
                    if (data.name != "") {
                        $("#lgn .int[name='password']").parent().append('<div class="tips"><i></i><b>' + data.msg + "</b></div>");
                        tAn($(".tips"));
                        $(".tips").click(function () {
                            tAn($(this));
                        });
                    } else {
                        location.href = "{{ route('login') }}";
                    }
                });
                return false;
            });
            function toJson(data) {
                return data;
            }
            function tAn(obj) {
                obj.animate({left: 270}, 150).animate({left: 260}, 150).animate({left: 270}, 150).animate({left: 260}, 150).animate({left: 270}, 150).animate({left: 260}, 150).animate({left: 270}, 150).animate({left: 260}, 150);
            }
        </script>
    </body>
</html>