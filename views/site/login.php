<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.zi-han.net/theme/hplus/login_v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:49 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <?php $appInfo = Yii::$app->params['app_info']; ?>
    <title><?=$appInfo['title']." - 登录"?></title>
    <meta name="keywords" content="<?=$appInfo['keywords']?>">
    <meta name="description" content="<?=$appInfo['description']?>">
    <link href="/static/css/bootstrap.min.css" rel="stylesheet">
    <link href="/static/css/font-awesome.min93e3.css?v=4.4.0" rel="stylesheet">
    <link href="/static/css/animate.min.css" rel="stylesheet">
    <link href="/static/css/style.min.css" rel="stylesheet">
    <link href="/static/css/login.min.css" rel="stylesheet">
    <link href="/static/layui/css/layui.css">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>
        if(window.top!==window.self){window.top.location=window.location};
    </script>

</head>

<body class="signin">
<div class="signinpanel">
    <div class="row">
        <div class="col-sm-7">
            <div class="signin-info">
                <div class="logopanel m-b">
                    <h1>[ LOGO ]</h1>
                </div>
                <div class="m-b"></div>
                <h4>欢迎使用 <strong><?=$appInfo['title']?></strong></h4>
                <ul class="m-b">
                    <?php
                    if (!empty($appInfo['advantage'])){
                        foreach ($appInfo['advantage'] as $val){
                    ?>
                    <li><i class="fa fa-arrow-circle-o-right m-r-xs"></i> <?=$val?></li>
                    <?php } }?>
                </ul>

            </div>
        </div>
        <div class="col-sm-5">
            <form>
                <h4 class="no-margins">登录：</h4>
                <p class="m-t-md">登录到<?=$appInfo['title']?></p>
                <input type="text" class="form-control uname" placeholder="用户名" />
                <input type="password" class="form-control pword m-b" placeholder="密码" />
                <a href="#">忘记密码了？</a>
                <span class="btn btn-success btn-block do-login">登录</span>
            </form>
        </div>
    </div>
    <div class="signup-footer">
        <div class="pull-left">
            &copy; 2015 All Rights Reserved. H+
        </div>
    </div>
</div>
</body>


<!-- Mirrored from www.zi-han.net/theme/hplus/login_v2.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Jan 2016 14:19:52 GMT -->
</html>
<script src="/static/js/jquery.min.js"></script>
<script src="/static/layer/layer.js"></script>
<script>
    $(".do-login").click(function () {
        var uname = $(".uname").val().trim();
        /*if (uname === '') {
            layer.msg("用户名不能为空");
            return false;
        }*/
        var pword = $(".pword").val().trim();
        /*if (pword === '') {
            lay.msg("密码不能为空");
            return false;
        }*/
        $.post("/site/login",{uname:uname,pword:pword},function (res) {
            if (res.code !== 0) {
                layer.msg(res.msg);
                return false;
            }
            layer.msg("欢迎回来，"+res.data.nickname +"!");
            window.location.href = "/";

        });

    });
</script>
