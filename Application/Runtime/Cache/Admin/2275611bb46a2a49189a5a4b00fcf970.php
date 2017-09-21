<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0051)http://che.petope.com/shang/admin/index/login/.html -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <script type="text/javascript" src="/zc/Public/js/jquery-1.8.2.min.js"></script>
    <link href="/zc/Public/admin/css/adminlogin.css" rel="stylesheet" type="text/css">
    <title>团尚科技汽车交易系统</title>
</head>

<body cz-shortcut-listen="true">
    <div class="LOGONEW">
        <script>
            var url = "<?php echo U('Home/User/verify_img',['action'=>'loginCode']);?>&r=';?>" + Math.random();
            function changeimg(url) {
                var myimg = document.getElementById("codeimg");
                var now = new Date().getTime();
                myimg.src = url;
            }
        </script>
        <form method="post" id="admin-form">
            <div class="bodybox">
                <div class="login_logo"></div>
                <input type="text" class="text" placeholder="请输入登录名称" id="username" name="username">
                <input type="password" class="text" placeholder="请输入登录密码" id="password" name="password">
                <input type="text" class="text_code" id="imgcode" name="imgcode" placeholder="验证码" maxlength="4">
                <a onclick="changeimg(url)">
                    <img src="<?php echo U('Home/User/verify_img',['action'=>'loginCode']);?>" id="codeimg"
                    style="position:relative;left:10px;top:10px;width: 120px;">
                </a>
                <button type="button" class="btn btn-default" id="btnReg" 
                onclick="yanzheng();" onfocus="this.blur();" 
                style="margin-left:50px;">登录</button>
            </div>
        </form>
    </div>
    <div id="footer">
        <p class="powered">Powered By <span class="copy">汽车交易系统 Copyright © 2017</span>
        </p>
    </div>
    <script>
        function yanzheng() {
            $.post("<?php echo U('Admin/gologin');?>",$("#admin-form").serialize(),function(data) {
                if(data.msg === 'success'){
                    location.href="<?php echo U('Admin/Index/index');?>";
                }
                else{
                    alert(data.msg);
                }
            });
		}
    </script>
</body>

</html>